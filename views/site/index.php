<?php

/* @var $this yii\web\View */
use yii\grid\GridView;
use yii\grid\DetailView;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\data\SqlDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Store form site';
$date = new DateTime('NOW');
$img = '<img></img>';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Store form</h1>

        <p class="lead"></p>

        <p></p>
    </div>
    
    <?php
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'file[]')->fileInput(['multiple' => true])->label('') ?>

<button> Add </button>

<?php ActiveForm::end() ?>


    <?php
    $data = [
        ['id' => 1, 'name' => 'name 1', 'created at' => $date->format('Y-m-d H:i'), 'img' => $img],
        ['id' => 2, 'name' => 'name 2'],
        ['id' => 100, 'name' => 'name 100'],
    ];

    $allFiles = \yii\helpers\FileHelper::findFiles('uploads/');
  
    $dataProvider = new ArrayDataProvider([
        'allModels' => $allFiles,
        'pagination' => [
            'pageSize' => 20,
       ],
        'sort' => [
            'attributes' => ['id', 'name', 'basename', 'created at', 'img', 'preview', 'source'],
        ],
   ]);
    
    $countquery = Yii::$app->db->createCommand('SELECT COUNT(*) FROM filestore')->queryScalar();
    $provider = new SqlDataProvider([
        'sql' => 'SELECT * FROM filestore',
        'totalCount' => $countquery,
        'pagination' => [
        'pageSize' => 10,
        ],
        'sort' => [
        'attributes' => [
        'data',
        'storemark',
        ],
        ],
        ]);
        $models = $provider->getModels();
        echo yii\grid\GridView::widget([
        'dataProvider' => $provider,
        'caption' => '',
        'columns' => [
        'data',
        [
            'attribute' => 'storemark',
            'label' => 'Mark',
        ], 
               
    ],
]); ?>

<h1 class="display-4"> View:</h1>
<?php $files=\yii\helpers\FileHelper::findFiles('uploads/');
    if (isset($files[0])) {
        foreach ($files as $index => $file) {
            $filepath = substr($file, strrpos($file, '/'));
            echo  Html::a(substr($file, strrpos($file, '/')), Url::base() . '/uploads/' . substr($file, strrpos($file, '/'))) . "<br/>" . "Preview:" . "<br/>" .  "<img" . " " . "style=" . "max-width:123px;height:auto" . " " .  "alt=" . "Preview" . " " .  "src=" . substr($file, strrpos($file, '/')) . ">" . "<br/>" .  "Render:" . "<br/>" . "<img" . " " .  "alt=" . "Render" . " " .  "src=" . substr($file, strrpos($file, '/')) . ">" . "<br/>";
        }
     } else {
            echo "Directory information absent";
    }
        ?>
    </div>
</div>
