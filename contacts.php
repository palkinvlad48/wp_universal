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
        <h2 class="cotacts-title">Через форму обратной связи:</h2>

        <form id="contacts_form" class="contacts-form">
          <input name="contact_name" id="" type="text" class="input contacts-input" placeholder="Ваше имя">
          <input name="contact_email" id="" type="email" class="input contacts-input" placeholder="Ваш email">
          <textarea name="contact_comment" id="" class="textarea contacts-textarea" placeholder="Ваш вопрос">
          </textarea>
          <button id="contacts_form_button" class="button more" type="submit">Отправить</button>
          <input hidden id="vp_send_cont_form" name="action" value="vp_send_cont_form" type="text">
          <?php wp_nonce_field('send_cont_form','_nonce_send_cont_form'); ?>
        </form>

        <?php //echo do_shortcode( '[contact-form-7 id="288" title="Контактная форма"]' )?>
      </div>
      <div class="right">
        <h2 class="cotacts-title">Или по этим контактам:</h2>
  
        <!--php if( have_rows('group_606451d3f34ff') ): ?>
        <php while( have_rows('group_606451d3f34ff') ): the_row(); 

        // Get sub field values.
        $email = get_sub_field('field_6064524cf8663');
        $address = get_sub_field('field_606452b9fbca6');
        $phone  = get_sub_field('field_6064534e55b7c');
        ?>
        <php 
          $email = the_sub_field( 'email' );
          if ($email) { echo '<a href="mail-to:' . $email . '">' . $email . '</a>'; }
        ?>
        <php
          $address = the_sub_field( 'address' );
          if ($address) { echo '<address class="">' . $address . '</address>'; }
        ?>
        <php
          $phone = the_sub_field( 'phone' );
          if ($phone) { echo '<a class="link-phone" href="tel:' . $phone . '">' . $phone . '</a>'; }
        ?>
        <php endwhile; ?>
        <php endif; -->
        
        <?php
          $email = get_post_meta( get_the_ID(), 'email', true );
          if ($email) { echo '<a href="mail-to:' . $email . '">' . $email . '</a>'; }
        ?>
        <?php
          $address = get_post_meta( get_the_ID(), 'address', true );
          if ($address) { echo '<address class="">' . $address . '</address>'; }
        ?>
        <?php
          $phone = get_post_meta( get_the_ID(), 'phone', true );
          if ($phone) { echo '<a class="link-phone" href="tel:' . $phone . '">' . $phone . '</a>'; }
        ?>
        
        
      </div>
    </div>
    
  </div>
</section>

<?php 
get_footer();