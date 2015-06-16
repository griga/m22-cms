<?php

class m140707_152522_templates extends yii\db\Migration
{
	public function up()
	{
       
        $this->delete('{{%system_template}}');
        $this->insert('{{%system_template}}',[
            'id'=>'1',
            'key'=>'registration_email',
            'comment'=>'{{sitename}} - название сайта {{email}} - email пользователя {{username}} - ФИО {{siteurl}} - адрес сайта {{activationurl}} - ссылка на код активации {{sitemail}} - email поддержки ',
        ]);
        $this->insert('{{%system_template}}',[
            'id'=>'2',
            'key'=>'forgot_password_email',
            'comment'=>'{{sitename}} - название сайта {{email}} - email пользователя {{username}} - ФИО {{siteurl}} - адрес сайта {{activationurl}} - ссылка на код активации {{sitemail}} - email поддержки ',
        ]);
        $this->insert('{{%system_template}}',[
            'id'=>'3',
            'key'=>'order_notify_email',
            'comment'=>'{{sitename}} - название сайта {{email}} - email пользователя {{username}} - ФИО {{siteurl}} - адрес сайта {{activationurl}} - ссылка на код активации {{sitemail}} - email поддержки ',
        ]);


        $this->insert('{{%system_template_lang}}',[
            'id'=>'1',
            'entity_id'=>'1',
            'language'=>'uk',
            'name'=>'Регiстрацiя на {{sitename}}: пiдтвердження e-mail',
            'content'=>'<p> 	                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Здравствуйте, {{username}}!</p><p> 	<br> 	Данный адрес <a href="mailto:{{email}}">{{email}}</a> был указан пользователем {{username}} <br> 	(возможно, это Вы) в качестве своего e-mail адреса <br> 	для получения информации от {{sitename}} ( <a href="{{siteurl}}">{{siteurl}}</a>).<br> 	<br> 	Если Вы этого не делали или не желаете получать информацию <br> 	от {{sitename}}, просто УДАЛИТЕ это письмо.</p><p> 	<br> 	Для подтверждения адреса нажмите ссылку: <a href="{{avtivation_url}}">{{avtivation_url}}</a> или скопируйте ее в окно браузера.<br> 	Это письмо написано роботом. Отвечать на него не нужно. <br> 	<br> 	Связаться со службой поддержки компании {{sitename}} Вы можете по адресу <a href="mailto:{{sitemail}}">{{sitemail}}</a></p>',
        ]);

        $this->insert('{{%system_template_lang}}',[
            'id'=>'2',
            'entity_id'=>'1',
            'language'=>'ru',
            'name'=>'Регистрация на {{sitename}}: подтверждение e-mail ',
            'content'=>'<p> 	                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Здравствуйте, {{username}}! </p> <p> 	<br> 	Данный адрес  	<a href="mailto:{{email}}">{{email}}</a> был указан пользователем {{username}} <br> 	(возможно, это Вы) в качестве своего e-mail адреса  	<br> 	для получения информации от {{sitename}} (  	<a href="{{siteurl}}">{{siteurl}}</a>). </p> <p> 	<br> 	Если Вы этого не делали или не желаете получать информацию  	<br> 	от {{sitename}}, просто УДАЛИТЕ это письмо. </p> <p> 	<br> 	Для подтверждения адреса нажмите ссылку:  	<a href="{{avtivation_url}}">{{avtivation_url}}</a> или скопируйте ее в окно браузера.<br> 	Это письмо написано роботом. Отвечать на него не нужно.  	<br> 	<br> 	Связаться со службой поддержки компании {{sitename}} Вы можете по адресу  	<a href="mailto:{{sitemail}}">{{sitemail}}</a> </p>',
        ]);

        $this->insert('{{%system_template_lang}}',[
            'id'=>'3',
            'entity_id'=>'1',
            'language'=>'en',
            'name'=> 'Registration on {{sitename}}: e-mail confirm',
            'content'=>'<p> 	                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Здравствуйте, {{username}}!</p><p> 	<br> 	Данный адрес <a href="mailto:{{email}}">{{email}}</a> был указан пользователем {{username}} <br> 	(возможно, это Вы) в качестве своего e-mail адреса <br> 	для получения информации от {{sitename}} ( <a href="{{siteurl}}">{{siteurl}}</a>).<br> 	<br> 	Если Вы этого не делали или не желаете получать информацию <br> 	от {{sitename}}, просто УДАЛИТЕ это письмо.</p><p> 	<br> 	Для подтверждения адреса нажмите ссылку: <a href="{{avtivation_url}}">{{avtivation_url}}</a> или скопируйте ее в окно браузера.<br> 	Это письмо написано роботом. Отвечать на него не нужно. <br> 	<br> 	Связаться со службой поддержки компании {{sitename}} Вы можете по адресу <a href="mailto:{{sitemail}}">{{sitemail}}</a></p>',
        ]);

        $this->insert('{{%system_template_lang}}',[
            'id'=>'4',
            'entity_id'=>'2',
            'language'=>'uk',
            'name'=>'Восстановление пароля на {{sitename}}',
            'content'=>'<p> 	                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Здравствуйте, {{username}}! </p> <p> 	Запрос на сброс пароля&nbsp;для Вашего аккаунта был произведен на&nbsp;<a href="{{siteurl}}">{{siteurl}}</a>. </p> <p> 	<br> 	Если Вы этого не делали просто УДАЛИТЕ это письмо. </p> <p> 	<br> 	Для того, чтобы указать новый пароль,&nbsp;нажмите ссылку:  	<a href="{{avtivation_url}}">{{avtivation_url}}</a> или скопируйте ее в окно браузера.<br> 	Это письмо написано роботом. Отвечать на него не нужно.  	<br> 	<br> 	Связаться со службой поддержки компании {{sitename}} Вы можете по адресу  	<a href="mailto:{{sitemail}}">{{sitemail}}</a> </p>',
        ]);

        $this->insert('{{%system_template_lang}}',[
            'id'=>'5',
            'entity_id'=>'2',
            'language'=>'ru',
            'name'=>'Восстановление пароля на {{sitename}}',
            'content'=>'<p> 	                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Здравствуйте, {{username}}! </p> <p> 	Запрос на сброс пароля&nbsp;для Вашего аккаунта был произведен на&nbsp;<a href="{{siteurl}}">{{siteurl}}</a>. </p> <p> 	<br> 	Если Вы этого не делали просто УДАЛИТЕ это письмо. </p> <p> 	<br> 	Для того, чтобы указать новый пароль,&nbsp;нажмите ссылку:  	<a href="{{avtivation_url}}">{{avtivation_url}}</a> или скопируйте ее в окно браузера.<br> 	Это письмо написано роботом. Отвечать на него не нужно.  	<br> 	<br> 	Связаться со службой поддержки компании {{sitename}} Вы можете по адресу  	<a href="mailto:{{sitemail}}">{{sitemail}}</a> </p>',
        ]);

        $this->insert('{{%system_template_lang}}',[
            'id'=>'6',
            'entity_id'=>'2',
            'language'=>'en',
            'name'=>'Восстановление пароля на {{sitename}}',
            'content'=>'<p> 	                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Здравствуйте, {{username}}! </p> <p> 	Запрос на сброс пароля&nbsp;для Вашего аккаунта был произведен на&nbsp;<a href="{{siteurl}}">{{siteurl}}</a>. </p> <p> 	<br> 	Если Вы этого не делали просто УДАЛИТЕ это письмо. </p> <p> 	<br> 	Для того, чтобы указать новый пароль,&nbsp;нажмите ссылку:  	<a href="{{avtivation_url}}">{{avtivation_url}}</a> или скопируйте ее в окно браузера.<br> 	Это письмо написано роботом. Отвечать на него не нужно.  	<br> 	<br> 	Связаться со службой поддержки компании {{sitename}} Вы можете по адресу  	<a href="mailto:{{sitemail}}">{{sitemail}}</a> </p>',
        ]);

        $this->insert('{{%system_template_lang}}',[
            'id'=>'7',
            'entity_id'=>'3',
            'language'=>'uk',
            'name'=>'Новый заказ на {{sitename}}',
            'content'=>'<p> 	 	                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Здравствуйте! </p> <p> 	Новый&nbsp;заказ&nbsp;на&nbsp; 	<a href="{{siteurl}}">{{siteurl}}</a> в {{printTime}}. </p> <p> 	от:  	<strong>{{fullname}}</strong><br> 	тел:  	<strong>{{phone}}</strong><br> 	адрес:  	<strong>{{address}}</strong> </p> <table> <thead> <tr> 	<th> 		Название &nbsp; 	</th> 	<th> 		Количество &nbsp;&nbsp; 	</th> 	<th> 		Цена &nbsp; &nbsp; &nbsp;&nbsp; 	</th> 	<th> 		Сумма 	</th> </tr> </thead> <thead> </thead> <tbody> <!--{{#items}}--> <tr> 	<td> 		{{name}} 	</td> 	<td> 		{{quantity}} 	</td> 	<td> 		{{price}} 	</td> 	<td> 		{{sum}} 	</td> </tr> <!--{{/items}}--> </tbody> <tfoot> <tr><td colspan="2"></td><td>Всего:</td><td>{{total}}</td></tr> </tfoot> </table>',
        ]);

        $this->insert('{{%system_template_lang}}',[
            'id'=>'8',
            'entity_id'=>'3',
            'language'=>'ru',
            'name'=>'Новый заказ на {{sitename}}',
            'content'=>'<p> 	 	                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Здравствуйте! </p> <p> 	Новый&nbsp;заказ&nbsp;на&nbsp; 	<a href="{{siteurl}}">{{siteurl}}</a> в {{printTime}}. </p> <p> 	от:  	<strong>{{fullname}}</strong><br> 	тел:  	<strong>{{phone}}</strong><br> 	адрес:  	<strong>{{address}}</strong> </p> <table> <thead> <tr> 	<th> 		Название &nbsp; 	</th> 	<th> 		Количество &nbsp;&nbsp; 	</th> 	<th> 		Цена &nbsp; &nbsp; &nbsp;&nbsp; 	</th> 	<th> 		Сумма 	</th> </tr> </thead> <thead> </thead> <tbody> <!--{{#items}}--> <tr> 	<td> 		{{name}} 	</td> 	<td> 		{{quantity}} 	</td> 	<td> 		{{price}} 	</td> 	<td> 		{{sum}} 	</td> </tr> <!--{{/items}}--> </tbody> <tfoot> <tr><td colspan="2"></td><td>Всего:</td><td>{{total}}</td></tr> </tfoot> </table>',
        ]);

        $this->insert('{{%system_template_lang}}',[
            'id'=>'9',
            'entity_id'=>'3',
            'language'=>'en',
            'name'=>'Новый заказ на {{sitename}}',
            'content'=>'<p> 	 	                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Здравствуйте! </p> <p> 	Новый&nbsp;заказ&nbsp;на&nbsp; 	<a href="{{siteurl}}">{{siteurl}}</a> в {{printTime}}. </p> <p> 	от:  	<strong>{{fullname}}</strong><br> 	тел:  	<strong>{{phone}}</strong><br> 	адрес:  	<strong>{{address}}</strong> </p> <table> <thead> <tr> 	<th> 		Название &nbsp; 	</th> 	<th> 		Количество &nbsp;&nbsp; 	</th> 	<th> 		Цена &nbsp; &nbsp; &nbsp;&nbsp; 	</th> 	<th> 		Сумма 	</th> </tr> </thead> <thead> </thead> <tbody> <!--{{#items}}--> <tr> 	<td> 		{{name}} 	</td> 	<td> 		{{quantity}} 	</td> 	<td> 		{{price}} 	</td> 	<td> 		{{sum}} 	</td> </tr> <!--{{/items}}--> </tbody> <tfoot> <tr><td colspan="2"></td><td>Всего:</td><td>{{total}}</td></tr> </tfoot> </table>',
        ]);


    }

	public function down()
	{
	}

}