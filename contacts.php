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
        <p class="page-text">Через форму обратной связи:</p>
        <form action="form.php" name="myform" class="contacts-form" method="POST">
          <input name="contact_name" id="" type="text" class="input contacts-input" placeholder="Ваше имя">
          <input name="contact_email" id="" type="email" class="input contacts-input" placeholder="Ваш email">
          <textarea name="contact_comment" id="" class="textarea contacts-textarea" placeholder="Ваш вопрос">
          </textarea>
          <button class="button more" type="submit">Отправить</button>
        </form>
        <?php echo do_shortcode( '[contact-form-7 id="288" title="Контактная форма"]' )?>
      </div>
      <div class="right">
        <p class="page-text">Или по этим контактам:</p>
        <a class="link-mail" href="mail-to:lg.oona@mail.ru">hello@forpeople.studio</a>
        <address class="">3522 I-75, Business Spur Sault Sainte Marie, MI, 49783</address>
        <a class="link-phone" href="tel:+74953225448">+7 495 322 54 48</a>

      </div>
    </div>
    
  </div>
</section>


<?php 
get_footer();