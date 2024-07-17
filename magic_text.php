<?php

$text = <<<TXT
<p class="big">
    Год основания:<b>1589 г.</b> Волгоград отмечает день города в <b>2-е воскресенье сентября</b>. <br>В <b>2023 году</b> эта дата - <b>10 сентября</b>.
</p>
<p class="float">
    <img src="https://www.calend.ru/img/content_events/i0/961.jpg" alt="Волгоград" width="300" height="200" itemprop="image">
    <span class="caption gray">Скульптура «Родина-мать зовет!» входит в число семи чудес России (Фото: Art Konovalov, по лицензии shutterstock.com)</span>
</p>
<p>
    <i><b>Великая Отечественная война в истории города</b></i></p><p><i>Важнейшей операцией Советской Армии в Великой Отечественной войне стала <a href="https://www.calend.ru/holidays/0/0/1869/">Сталинградская битва</a> (17.07.1942 - 02.02.1943). Целью боевых действий советских войск являлись оборона  Сталинграда и разгром действовавшей на сталинградском направлении группировки противника. Победа советских войск в Сталинградской битве имела решающее значение для победы Советского Союза в Великой Отечественной войне.</i>
</p>
TXT;

// Максимальное количество слов
$maxWords = 29;

// Создаём DOMDocument и загружаем HTML
$dom = new DOMDocument();
$dom->loadHTML(mb_convert_encoding($text, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

// Используем XPath для выбора всех текстовых узлов в документе
$xpath = new DOMXPath($dom);
$textNodes = $xpath->query('//text()[not(ancestor::script) and not(ancestor::style)]');

$currentWords = 0;
$cut = false;
$nodeToCut = null;
$remainingWords = 0;

// Перебираем текстовые узлы
foreach ($textNodes as $node) {
    // Разбиваем текст на слова
    $words = preg_split('/\s+/', $node->nodeValue, -1, PREG_SPLIT_NO_EMPTY);

    // Если текущее количество слов меньше максимального
    if ($currentWords + count($words) <= $maxWords) {
        $currentWords += count($words);
    } else {
        // Обрезаем текст до максимального количества слов
        $remainingWords = $maxWords - $currentWords;
        $words = array_slice($words, 0, $remainingWords);
        $node->nodeValue = implode(' ', $words) . '...';
        $cut = true;
        $nodeToCut = $node;
        break;
    }
}

// Функция для рекурсивного удаления всех последующих узлов
function removeFollowingNodes($node) {
    while ($nextNode = $node->nextSibling) {
        $node->parentNode->removeChild($nextNode);
    }
    if ($parent = $node->parentNode) {
        removeFollowingNodes($parent);
    }
}

// Удаляем все последующие узлы после обрезки
if ($cut && $nodeToCut) {
    removeFollowingNodes($nodeToCut);
}

// Получаем обновлённый HTML
$newText = $dom->saveHTML();