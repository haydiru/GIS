<?php
use yii\bootstrap\Nav;

?>
<aside class="main-sidebar">

    <section class="sidebar">
		<?= \common\components\MenuWidget::widget([
                'options'=>['class'=>'sidebar-menu'],
                'labelTemplate' => '<a href="#">{icon}<span>{label}</span>{right-icon}{badge}</a>',
                'linkTemplate' => '<a href="{url}">{icon}<span>{label}</span>{right-icon}{badge}</a>',
                'submenuTemplate'=>"\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n",
                'activateParents'=>true,
                'items'=>[
                    [
                        'label'=>'Gii',
                        'icon'=>'<i class="fa fa-file-code-o"></i>',
                        'url'=>['/gii'],
                        
                    ],
                    [
                        'label'=>'Debug',
                        'icon'=>'<i class="fa fa-dashboard"></i>',
                        'url'=>['/debug'],
                        
                    ], 
					[
                        'label'=>'Import Data',
                        'icon'=>'<i class="fa fa-cloud-upload"></i>',
                        'url'=>['/site/upload'],
                        
                    ],
			[
            'label' => 'Manage',
            'icon' => '<i class="fa fa-gears"></i>',
			'items' => [
				['label' => 'Fakta', 'icon'=>'<i class="fa fa-empire"></i>', 'url'=>['/fakta']],
                ['label' => 'Topik', 'icon'=>'<i class="fa fa-leanpub"></i>', 'url'=>['/topik']],
                ['label' => 'Variabel', 'icon'=>'<i class="fa fa-list-ul"></i>', 'url'=>['/variabel']],
                ['label' => 'Kategori', 'icon'=>'<i class="fa fa-list"></i>', 'url'=>['/kategori']],
                ['label' => 'Link Peta', 'icon'=>'<i class="fa fa-connectdevelop"></i>', 'url'=>['/geoserver-ulr']],
            ],
        ],
                ]
            ]); ?>

    </section>

</aside>
