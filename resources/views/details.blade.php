<h2>Общая информация</h2>
<table class="table">
    <tr>
        <th>Модель</th>
        <td>{{$grade->car->title}}</td>
    </tr>
    <tr>
        <th>Кмплектация:</th>
        <td>{{$grade->title}}</td>
    </tr>
    <tr>
        <th>Описание:</th>
        <td>{{$grade->engine_desc}}</td>
    </tr>
    <tr>
        <th>Привод:</th>
        <td>{{$grade->wheeldrive}}</td>
    </tr>
    <tr>
        <th>Двигатель:</th>
        <td>{{$grade->engine}}</td>
    </tr>
    <tr>
        <th>Трансмиссия:</th>
        <td>{{$grade->transmission}}</td>
    </tr>
    <tr>
        <th>Кузов:</th>
        <td>{{$grade->body}}</td>
    </tr>
    <tr>
        <th>Цена:</th>
        <td>{{$grade->price}}</td>
    </tr>
    <tr>
        <th>Скидка:</th>
        <td>{{$grade->pricediscount}}</td>
    </tr>
</table>
<h2>Особенности</h2>
<table class="table">
    @foreach($grade->features as $feature)
        <tr>
            <td>{{$feature->name}}</td>
        </tr>
    @endforeach
</table>
<h2>Цвета</h2>
<table class="table">
    <tr>
        <th>RGB</th>
        <th>Код</th>
        <th>Название</th>
        <th>Тип</th>
        <th>Цена</th>
        <th>swatch</th>
    </tr>
    @foreach($grade->colors as $color)
        <tr>
            <td>{{$color->rgb}}</td>
            <td>{{$color->code}}</td>
            <td>{{$color->title}}</td>
            <td>{{$color->type}}</td>
            <td>{{$color->price}}</td>
            <td>{{$color->swatch}}</td>
        </tr>
    @endforeach
</table>
<h2>Спецификации</h2>
<table class="table">
    @foreach($grade->specifications_list() as $category)
        <tr>
            <th colspan="2" class="text-center">{{$category['name']}}</th>
        </tr>
        @foreach($category['names'] as $name)
            <tr>
                <th>{{$name['name']}}</th>
                <td class="text-right">{{$name['value']}}</td>
            </tr>
        @endforeach
    @endforeach
</table>