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
        $provider = new ArrayDataProvider([
            'allModels' => $this->peopleDataList(),
            'sort' => [
                'attributes' => ['id', 'name', 'age', 'height'],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render('dataView', ['dataProvider' => $provider]);
    }

	public function actionPdf()
	{
	    $this->layout = 'pdf';
	    $provider = new ArrayDataProvider([
	        'allModels' => $this->peopleDataList(),
	        'sort' => [
	            'attributes' => ['id', 'name', 'age', 'height'],
	        ],
	        'pagination' => [
	            'pageSize' => 10,
	        ],
	    ]);
	    $html = $this->render('dataView', ['dataProvider' => $provider]);
	    return $html;
	    $header = $this->render('pdfHeader');
// 		Yii::$app->response->format = 'pdf';
		$pdf = Yii::$app->htmlToPdf->convert($html, ['header-html' => $header]);
// 		file_put_contents('a.pdf', $pdf);
 		return $pdf;
		
	}
	
	/**
	 * Generate a random list of people data.
	 * @param integer $num Number of people to be generated.
	 * @return array[] Each element contains name, age and height.
	 */
	private function peopleDataList($num = 30)
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
