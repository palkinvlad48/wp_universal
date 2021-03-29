<?php
/*
Template Name: Страница Контакты
Template Post Type: page
*/

get_header();
?>
<section class="section-dark">
  <div class="container">
    <?php the_title('<h1 class="page-title">', '</h1>', true); ?>
    <div class="contacts-wrapper">
      <div class="left">
        <p class="page-text">Свяжитесь с нами через форму обратной связи</p>
        <form action="form.php" name="myform" class="contacts-form" method="POST">
          <input name="contact_name" id="" type="text" class="input contacts-input" placeholder="Ваше имя">
          <input name="contact_email" id="" type="email" class="input contacts-input" placeholder="Ваш email">
          <textarea name="contact_comment" id="" class="textarea contacts-textarea" placeholder="Ваш вопрос">
          </textarea>
          <button class="button more" type="submit">Отправить</button>
        </form>
      </div>
      <div class="right">
      
      </div>
    </div>
    
  </div>
</section>


<?php 
get_footer();