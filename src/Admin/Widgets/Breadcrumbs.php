<?php

namespace CubeSystems\Leaf\Admin\Widgets;

use CubeSystems\Leaf\Html\Html;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;

/**
 * Class Breadcrumbs
 * @package CubeSystems\Leaf\Admin\Widgets
 */
class Breadcrumbs implements Renderable
{
    /**
     * @var Collection
     */
    protected $items;

    /**
     * Breadcrumbs constructor.
     */
    public function __construct()
    {
        $this->items = new Collection();
        $this->addItem( trans( 'leaf::breadcrumbs.home' ), route( 'admin.dashboard' ) );
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->render();
    }

    /**
     * @param $title
     * @param $url
     * @return Breadcrumbs
     */
    public function addItem( $title, $url )
    {
        $this->items->push( [
            'title' => $title,
            'url' => $url
        ] );

        return $this;
    }

    /**
     * @return \CubeSystems\Leaf\Html\Elements\Element
     */
    public function render()
    {
        $total = $this->items->count();

        $list = $this->items->map( function ( array $item, $key ) use ( $total )
        {
            $listItem = Html::li(
                Html::link( $item['title'] )
                    ->addAttributes( [
                        'href' => $item['url']
                    ] )
            );

            if( $key !== $total - 1 )
            {
                $listItem->append( Html::i()->addClass( 'fa fa-small fa-chevron-right' ) );
            }

            return $listItem;
        } );

        return Html::nav(
            Html::ul( $list->toArray() )->addClass( 'block breadcrumbs' )
        );
    }
}