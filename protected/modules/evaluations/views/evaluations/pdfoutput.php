<?php
/* @var $this EvaluationsController */
/* @var $model Evaluations */
/* @var $answersDataProvider dataProvider */
?>
<page backtop="7mm" backbottom="7mm" backleft="7mm" backright="7mm"> 
	<page_header> 
		<?php echo "Date: " . CHtml::encode(date('g:i a m/d/Y', strtotime($model->evaluationdate)));?>
	</page_header> 
	<page_footer> 
		Page [[page_cu]] of [[page_nb]]
	</page_footer> 
	<?php echo "<b>Employee:</b> " . $model->employee0->firstname . " " . $model->employee0->lastname . "<br/>";?>
	<?php echo "<b>Evaluator:</b> " . $model->evaluator0->firstname . " " . $model->evaluator0->lastname . "<br/>";?>
	
<?php
$data = $answersDataProvider->getData();
foreach($data as $i => $item)
{
	Yii::app()->controller->renderPartial('_viewPdf',
		array('data' => $item, 'this' => $this));
}
echo "<br/><p><b>This form acknowledges that my supervisor and I met and discussed this performance evaluation. 
		My signature does not imply that I agree with these evaluation results.</b></p>";

echo "<h4>Supervisor's Signature:<span style='text-decoration:underline;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></h4>";

echo "<h4>Employee's Signature:<span style='text-decoration:underline;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></h4>";
?>

<?php echo $this->renderPartial('_instructions'); ?>

</page>