@extends('layouts.app')

@section('content')

<div class="container py-5">
    <h2>Варіанти оплати:</h2>
    <ul class="fs-5">
        <li>Оплата готівкою при самовивезенні</li>
        <li>Оплата платіжними картами Visa та MasterCard - WayForPay</li>
        <li>Післяплата Новою Поштою</li>
    </ul>
    <h2 class="pt-3">Доставка по Україні</h2>
    <ul class="fs-5">
        <li>Самовивезення</li>
        <li>Доставка Новою Поштою</li>
    </ul>
    <h2 class="pt-3">Доставка у відділення «Нова пошта»</h2>
    <ul class="fs-5">
        <li>Зазвичай доставка займає 1-3 дні.</li>
        <li>Вартість доставки розраховується відповідно до тарифів сервісу доставки.</li>
        <li>При отриманні замовлення при собі необхідно мати паспорт або водійське посвідчення.</li>
        <li>Передоплачений товар може отримати тільки та людина, на яку оформлена доставка.</li>
    </ul>
    <h2 class="pt-3">Умови доставки швидкопсувних товарів до "Нової Пошти":</h2>
    <ul class="fs-5">
        <li>
            Термін доставки швидкопсувних товарів до «Нової Пошти» становить до 3 робочих днів з моменту замовлення.
        </li>
        <li>
            Доставка здійснюється за рахунок замовника.
        </li>
        <li>
            Клієнт має право відмовитися від замовлення до моменту відправки товару згідно. Повернення коштів за оплачений товар протягом 5-7 днів.
        </li>
        <li>
            У разі виявлення браку товару після його отримання клієнт має право вимагати заміну товару або повернення коштів.  Повернення коштів за оплачений товар протягом 5-7 днів.
        </li>
        <li>
            Компанія не несе відповідальності за транспортні затримки, які стали з вини перевізника.
        </li>
        <li>
            Клієнт зобов'язаний вказати точну адресу доставки, контактний номер телефону та ім'я отримувача.
        </li>
        <li>
            Компанія залишає за собою право на зміну термінів доставки в залежності від обсягу замовлень та інших матеріалів.
        </li>
        <li>
            У разі виникнення будь-яких питань із приводу доставки товару клієнт може звернутися до нашої служби підтримки через <a href="{{ route('contacts.index') }}" target="_blank">контактну форму</a> . Ми завжди готові надати допомогу та відповісти на всі запитання.
        </li>
        <li>
            Отримання товару. Після надходження товару до відділення «Нової Пошти» вам буде надіслано SMS-повідомлення або електронний лист з відправленням. Ви можете забрати товар відповідно до графіка роботи відділення. При отриманні товару, будь ласка, не забудьте пред'явити документ, який підтверджує вашу особу (паспорт або водійське посвідчення) та номер відправлення.
        </li>
      </ul>

    {{-- <div class="accordion accordion-flush pt-5" id="accordionFlushExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                <h3>Умови доставки швидкопсувних товарів до "Нової Пошти":</h3>
            </button>
          </h2>
          <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <ul class="fs-5">
                    <li>
                        Термін доставки швидкопсувних товарів до «Нової Пошти» становить до 3 робочих днів з моменту замовлення.
                    </li>
                    <li>
                        Доставка здійснюється за рахунок замовника.
                    </li>
                    <li>
                        Клієнт має право відмовитися від замовлення до моменту відправки товару згідно. Повернення коштів за оплачений товар протягом 5-7 днів.
                    </li>
                    <li>
                        У разі виявлення браку товару після його отримання клієнт має право вимагати заміну товару або повернення коштів.  Повернення коштів за оплачений товар протягом 5-7 днів.
                    </li>
                    <li>
                        Компанія не несе відповідальності за транспортні затримки, які стали з вини перевізника.
                    </li>
                    <li>
                        Клієнт зобов'язаний вказати точну адресу доставки, контактний номер телефону та ім'я отримувача.
                    </li>
                    <li>
                        Компанія залишає за собою право на зміну термінів доставки в залежності від обсягу замовлень та інших матеріалів.
                    </li>
                    <li>
                        У разі виникнення будь-яких питань із приводу доставки товару клієнт може звернутися до нашої служби підтримки через <a href="{{ route('contacts.index') }}" target="_blank">контактну форму</a> . Ми завжди готові надати допомогу та відповісти на всі запитання.
                    </li>
                    <li>
                        Отримання товару. Після надходження товару до відділення «Нової Пошти» вам буде надіслано SMS-повідомлення або електронний лист з відправленням. Ви можете забрати товар відповідно до графіка роботи відділення. При отриманні товару, будь ласка, не забудьте пред'явити документ, який підтверджує вашу особу (паспорт або водійське посвідчення) та номер відправлення.
                    </li>
                  </ul>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
              Accordion Item #2
            </button>
          </h2>
          <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
              Accordion Item #3
            </button>
          </h2>
          <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
          </div>
        </div>
    </div> --}}
</div>

@endsection







