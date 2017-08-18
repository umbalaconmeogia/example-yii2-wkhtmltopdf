<?php

namespace app\controllers;

use Yii;
use yii\data\ArrayDataProvider;
use yii\web\Controller;

class DemoWkhtmltopdfController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('dataView', ['dataProvider' => $this->dataProvider()]);
    }
    
    public function actionPdfLink()
    {
        $this->layout = 'pdf';
        return $this->render('dataView', ['dataProvider' => $this->dataProvider()]);
    }
    
	public function actionPdfDownload()
	{
	    Yii::$app->html2pdf
	    ->convertFile('http://projects.local/openSource/example-yii2-wkhtmltopdf/src/example-yii2-wkhtmltopdf/web/index.php?r=demo-wkhtmltopdf%2Fpdf-link')
	    ->saveAs('G:\data\projects.it\openSource\example-yii2-wkhtmltopdf\src\example-yii2-wkhtmltopdf\bin\wkhtmltopdf\output.pdf');
	}
	
	/**
	 * Generate data provider
	 * @return \yii\data\ArrayDataProvider
	 */
	private function dataProvider()
	{
	    return new ArrayDataProvider([
	        'allModels' => $this->peopleDataList(),
	        'sort' => [
	            'attributes' => ['id', 'name', 'age', 'height'],
	        ],
	        'pagination' => [
	            'pageSize' => 50,
	        ],
	    ]);
	}
	
	/**
	 * Generate a random list of people data.
	 * @param integer $num Number of people to be generated.
	 * @return array[] Each element contains name, age and height.
	 */
	private function peopleDataList($num = 100)
	{
		$people = [];
		$familyNames = [
			'佐藤',
			'鈴木',
			'高橋',
			'田中',
			'伊藤',
			'渡辺',
			'山本',
			'中村',
			'小林',
			'加藤',
			'吉田',
			'山田',
			'佐々木',
			'山口',
			'松本',
			'井上',
			'木村',
			'林',
			'斎藤',
			'清水',
		];
		$firstNames = ['太郎', '次郎', '花子'];
		$familyIndex = 0;
		$firstIndex = 0;
		for ($i = 0; $i < $num; $i++, $familyIndex = ++$familyIndex % count($familyNames), $firstIndex = ++$firstIndex % count($firstNames)) {
			$people[] = [
			    'id' => $i + 1,
			    'name' => $familyNames[$familyIndex]. ' ' . $firstNames[$firstIndex],
				'age' => 10 + ($i % 31), // 10-40
				'height' => (150 + ($i % 41)) . ' cm', // 150-190
			];
		}
		return $people;
	}
}
