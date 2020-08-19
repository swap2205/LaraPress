<?php 

namespace Modules\CMS\Widgets;

use Facuz\Theme\Theme;
use Facuz\Theme\Widget;
use Modules\CMS\Entities\Page;

class Demo extends Widget {

    /**
     * Widget template.
     *
     * @var string
     */
    public $template = 'cms::widgets.demo';

    /**
     * Watching widget tpl on everywhere.
     *
     * @var boolean
     */
    public $watch = true;

    /**
     * Arrtibutes pass from a widget.
     *
     * @var array
     */
    public $attributes = array(
        //'userId' => 9999,
        'label'  => 'Default widget label',
    );

    /**
     * Turn on/off widget.
     *
     * @var boolean
     */
    public $enable = true;

    /**
     * Code to start this widget.
     *
     * @return void
     */
    public function init(Theme $theme)
    {
        // Initialize widget.

        //$theme->asset()->usePath()->add('widget-name', 'js/widget-execute.js', array('jquery', 'jqueryui'));
        //$this->setAttribute('user', User::find($this->getAttribute('userId')));
    }

    /**
     * Logic given to a widget and pass to widget's view.
     *
     * @return array
     */
    public function run()
    {
        $label = $this->getAttribute('label');
        
        $count = $this->getAttribute('count');

        //$this->setAttribute('label', 'changed');

        $attrs = $this->getAttributes();
        
        $attrs['data']= Page::where('page_type',$label)->limit($count)->get();
        
        return $attrs;
    }

}