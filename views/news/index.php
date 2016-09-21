<?php foreach ($data as $value): ?>
	<div class="mainstyle">
		<h3><a href="/news/view?id=<?= $value->id; ?>"><?= $value->title; ?></a></h3>
		<em>Опубликовано: <?= $value->date; ?></em>
		<p><?= cutStr($value->content); ?></p>
	</div>	
<?php endforeach ?>

<?php
/**
 * [cutStr Функция которая обрезает строку, при этом не обрезая слова]
 * @param  string  $str     [Сюда передается строка которую нужно обрезать]
 * @param  integer $length  [Указываем сколько символов оставить в строке, по умолчанию 300]
 * @param  string  $postfix [Постфикс, окончание строки, по умолчанию: ...]
 * @return string           [Возвращает обработанную строку]
 */
function cutStr($str, $length = 300, $postfix = '...')
{
    if (strlen($str) <= $length)
        return $str;
 
    $temp = substr($str, 0, $length);
    return substr($temp, 0, strrpos($temp, ' ') ) . $postfix;
}
?>

