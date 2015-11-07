<?php
class jazzweb_field {

    function __construct() {

    }

    /**
     * Return field's name with checked type (subfield, option etc)
     * @since 2.0.0
     * @param $name - Name of field
     * @return bool|mixed|null|void
     */
    public function get($name) {
        if( get_sub_field($name) !== false ) {
            return get_sub_field($name);
        }
        elseif( !is_null( get_field($name) ) ) {
            return get_field($name);
        }
        elseif( get_sub_field($name,'option') !== false ) {
            return get_sub_field($name,'option');
        }
        else {
            return get_field($name,'option');
        }
    }

    /**
     * Echo field
     * @param $name - Name of field
     */
    public function the($name) {
        echo $this->get($name);
    }

    /**
     * Echo image with parameters by ID
     * @since 2.0.0
     * @param string $name - Name of field
     * @param string $size - Size of image. Use registered size (thumbnail, medium etc) or array(150,150)
     * @param bool $link - Use link to full image
     */
    public function image($name = '', $size = 'thumbnail', $link = true) {
        $field = $this->get($name);
        if( $field ) {
            if( $link == true ) {
                ?>
                <a href="<?php echo wp_get_attachment_url($field); ?>" id="<?php echo $name;?>">
                    <?php
                    echo wp_get_attachment_image($field, $size);
                    ?>
                </a>
            <?php
            }
            else {
                echo wp_get_attachment_image($field, $size);
            }
        }

    }

    /**
     * Echo text
     * @since 2.0.0
     * @param string $name - Name of field
     * @param bool $paragraph - Use paragraph
     */
    public function text($name = '', $paragraph = true) {
        $field = $this->get($name);
        if( $field ) {
            if( $paragraph == true ) {
                ?>
                <p id="<?php echo $name;?>">
                    <?php
                    echo $field;
                    ?>
                </p>
            <?php
            }
            else {
                echo $field;
            }
        }


    }

    /**
     * Echo phone from option page with parameters
     * @since 2.0.0
     * @version 1.1
     * @param string $name - Start of phone field's name, ex phone_1
     * @param bool $link - Use link to phone
     * @param bool $paragraph - Use paragraph
     * @param string $addCode - Add phone code before number
     */
    public function phone($name = '', $link = true, $paragraph = true, $addCode = '') {
        $phone_text = $this->get($name);
        $a_id = 'id="'. $name .'"';
        $phone = preg_replace('#[^\d]#', '', $phone_text);
        $phone_number = implode('', array($addCode, $phone));
        if( $paragraph == true ) {
            $a_id = null;
            ?>
            <p id="<?php echo $name;?>">
        <?php
        }
        if( $link == true ) {
            ?>
            <a href="tel:<?php echo $phone_number;?>" <?php echo $a_id;?>>
                <?php echo $phone_text;?>
            </a>
        <?php
        }
        else {
            echo $phone_text;
        }
        if( $paragraph = true ) {
            ?>
            </p>
        <?php
        }
    }

    /**
     * Echo email from option page with parameters
     * @since 2.0.0
     * @param string $name - Name of email field
     * @param bool $link - Use link to email
     * @param bool $paragraph - Use paragraph
     */
    public function email($name = '', $link = true, $paragraph = true) {
        $field = get_field($name, 'option');
        $a_id = 'id="'. $name .'"';
        if( $paragraph == true ) {
            $a_id = null;
            ?>
            <p id="<?php echo $name;?>">
        <?php
        }
        if( $link == true ) {
            ?>
            <a href="mailto:<?php echo $field; ?>" <?php echo $a_id;?>>
                <?php
                echo $field;
                ?>
            </a>
        <?php
        }
        else {
            echo $field;
        }
        if( $paragraph = true ) {
            ?>
            </p>
        <?php
        }
    }

    /**
     * Echo logo
     * @since 2.0.0
     * @version 1.1
     * @param string $name - Name of logo field
     * @param string $size - Size of image. Use registered size (thumbnail, medium etc) or array(150,150)
     * @param bool $link - Use link to homepage
     */
    public function logo($name = 'logo', $size = 'full', $link = true) {
        if( $link == true ) {
            ?>
            <a href="<?php bloginfo('url');?>" id="<?php echo $name;?>" title="<?php bloginfo('name');?>">
                <?php
                $this->image($name,$size,false);
                ?>
            </a>
        <?php
        }
        else {
            $this->image($name,$size,false);
        }
    }

    /**
     * Echo gallery images
     * @since 2.0.0.1
     * @version 1.1
     * @param string $name - Name of gallery field
     * @param string $size - Size of image. Use registered size (thumbnail, medium etc) or array(150,150)
     * @param bool $link - Use link to full size image
     * @param bool $caption - Echo image caption
     */
    public function gallery($name = '', $size = 'thumbnail', $link = true, $caption = false) {
        $fields = $this->get($name);
        if( $fields ) {
            $count = 0;
            ?>
            <ul id="<?php echo $name;?>-gallery">
                <?php foreach( $fields as $field ) {
                    $count++;
                    $caption_text = null;
                    if($caption == true) {
                        $caption_text = $field['caption'];
                    }
                    ?>
                    <li class="item">
                        <?php
                        if( $link == true ) {
                            ?>
                            <a href="<?php echo wp_get_attachment_url($field['ID']); ?>" id="<?php echo $name .'-'. $count;?>">
                                <?php
                                echo wp_get_attachment_image($field['ID'], $size);
                                echo $caption_text;
                                ?>
                            </a>
                        <?php
                        }
                        else {
                            echo wp_get_attachment_image($field['ID'], $size);
                            echo $caption_text;
                        }
                        ?>
                    </li>
                <?php
                } ?>
            </ul>
        <?php
        }
    }

    /**
     * Echo title in <H> tag
     * @since 2.0.0.2
     * @param string $name - Name of field
     * @param string $tag - H tag, ex: h1,h2,h3 etc
     */
    public function title($name = '', $tag = 'h1') {
        $field = $this->get($name);
        if($field) {
            echo '<' . $tag . '>' . $field . '</' . $tag . '>';
        }
    }
}