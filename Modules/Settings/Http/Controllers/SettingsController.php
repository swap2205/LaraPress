<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Modules\Settings\Entities\AdminNavigation;
use Modules\Settings\Entities\Setting;
use Theme;
class SettingsController extends Controller
{
    public function __construct()
    {
        $this->theme = Theme::uses('admin');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = [];

        $layout_dir = scandir(public_path('themes'));
        unset($layout_dir[0],$layout_dir[1]);
        $template = [];
        foreach ($layout_dir as $value) {
            $template[$value] = ucwords(str_replace('_',' ',$value));
        }
        unset($template['admin']);
        $data['themes'] = $template;

        $data['settings_data'] = array_column(json_decode(Setting::select('key','value','type')->get(),1),'value','key');
        // $data['settings_fields'] = array_column($data['settings_data'],'value','key');
        // return($data);
        $this->theme->asset()->themePath()->add('settings-js','js/settings.js');
        return $this->theme->setTitle('Settings')->view('settings::index',$data);
    }

    public function index_admin_nav()
    {
        $data = [];

        $data['navs'] =[];
        $navs = json_decode(AdminNavigation::orderBy('nav_order')->get(),1);

        // return($navs);
        foreach ($navs as $nk => $nval) {
            if($nval['parent_id']==0){
                $data['navs'][$nval['id']] = $nval;
            }
            else{
                $data['navs'][$nval['parent_id']]['children'][] = $nval;
            }
        }
        // return($data);
        $this->theme->asset()->add('nestable-css','//cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.css');
        $this->theme->asset()->add('nestable-js','//cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js');
        $this->theme->asset()->themePath()->add('settings-js','js/admin_nav.js');
        return $this->theme->setTitle('Admin Navigation')->view('settings::admin_nav',$data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        foreach ($request->input('key') as $key => $value) {
            # code...

            $sett = Setting::updateOrCreate(
                ['key' => $key, 'type' => $request->input('type')],
                ['value' => $value]
            );
        }

        return ['status'=>(boolean)$sett];
    }
    public function store_admin_nav(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'uri' => 'required',
            'icon_class' => 'required',
        ]);
        $data['status'] = $request->input('nav_status') ?? 0;
        // dd($data);
        $nav = AdminNavigation::create($data);

        return ['status'=>(boolean)!empty($nav),
                'nav_data' => $nav
            ];
    }

    public function update_admin_nav(Request $request, AdminNavigation $nav)
    {
        // dd($nav);

        $data = $request->validate([
            'title' => 'required',
            'uri' => 'required',
            'icon_class' => 'required',
        ]);
        $data['status'] = $request->input('nav_status') ?? 0;

        $nav->title = $data['title'];
        $nav->uri = $data['uri'];
        $nav->icon_class = $data['icon_class'];
        $nav->status = $data['status'];

        $nav->save();

        return ['status'=>true,'nav_data' => $nav];
    }

    public function update_admin_nav_order(Request $request)
    {

        $nav_data = json_decode($request->input('nav_order'),1);
        // dd($nav_data);

        foreach ($nav_data as $nkey => $nval) {
            # code...
            $nav = AdminNavigation::find($nval['id']);
            $nav->parent_id = $nval['parent_id'] ?? 0;
            $nav->nav_order = $nkey+1;
            $nav->save();
        }
        return ['status'=>true];

    }

    public function themes(){
        $data = [];

        $layout_dir = scandir(public_path('themes'));
        unset($layout_dir[0],$layout_dir[1]);
        $template = [];
        foreach ($layout_dir as $value) {
            $template[$value] = ucwords(preg_replace('/[^A-Za-z0-9]/',' ',$value));
        }
        unset($template['admin']);
        $data['themes'] = $template;


        $this->theme->asset()->themePath()->add('settings-js','js/settings.js');

        $this->theme->setTitle('Themes');
        return $this->theme->view('settings::themes',$data);
    }

    public function save_theme(){

    }
    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('settings::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('settings::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

        /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $data = [
            'PORTAL_NAME'=>'"Swapnil CMS V1"',
            'APP_THEME'=>'default',
            'MAIL_USERNAME'=>'swapnil',
            'MAIL_PASSWORD'=>'swapnil@123',
        ];

        $val = $this->setEnvironmentValues($data);
        Artisan::call('config:clear');
        dd($val);
        return view('settings::create');
    }


    private function setEnvironmentValues(array $values)
    {

        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {

                $str .= "\n"; // In case the searched variable is in the last line without \n
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                // If key does not exist, add it
                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$envKey}={$envValue}\n";
                } else {
                    $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                }

            }
        }

        $str = substr($str, 0, -1);

        if (!file_put_contents($envFile, trim($str))) return false;
        return true;

    }


    /*
    ** Admin navigation helper - it is used to generate Admin navigation sidebar
    */
    public static function get_admin_navigation(){
        $data = [];

        // $data['navs'] =[];
        $navs = json_decode(AdminNavigation::where('status',1)->orderBy('nav_order')->get(),1);

        // return($navs);
        foreach ($navs as $nk => $nval) {
            if($nval['parent_id']==0){
                $data[$nval['id']] = $nval;
            }
            else{
               /*  $data['navs'][$nval['parent_id']]['uri'] = (array)$data['navs'][$nval['parent_id']]['uri'];
                $data['navs'][$nval['parent_id']]['uri'][] = $nval; */
                if(isset($data[$nval['parent_id']])){
                    $data[$nval['parent_id']]['children'][] = $nval;
                }
            }
        }
        return($data);
    }
}
