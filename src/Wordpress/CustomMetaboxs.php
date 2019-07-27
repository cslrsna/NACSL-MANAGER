<?php
/**
 * Created by Bruno Pouliot.
 * Email: dev.lecanardnoir@gmail.com
 * Date: 7/24/19
 * Time: 5:27 PM
 */

namespace nacsl\Wordpress;

class CustomMetaboxs implements MetaboxInterfaces
{

    private $_id = "";
    private $_title = "";
    private $_screen;
    private $_context = "";
    private $_priority = "";
    private $_from = array();

    /*******************************************************************   GETTER   */

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->_id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->_title;
    }

    /**
     * @return mixed
     */
    public function getScreen()
    {
        return $this->_screen;
    }

    /**
     * @return string
     */
    public function getContext(): string
    {
        return $this->_context;
    }

    /**
     * @return string
     */
    public function getPriority(): string
    {
        return $this->_priority;
    }

    /**
     * @return array
     */
    public function getFrom(): array
    {
        return $this->_from;
    }

    /*******************************************************************   SETTER   */

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->_id = $id;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->_title = $title;
    }

    /**
     * @param  $screen
     */
    public function setScreen($screen): void
    {
        $this->_screen = $screen;
    }

    /**
     * @param string $context
     */
    public function setContext(string $context): void
    {
        $this->_context = $context;
    }

    /**
     * @param string $priority
     */
    public function setPriority(string $priority): void
    {
        $this->_priority = $priority;
    }

    /**
     * @param array $from
     */
    public function setFrom(array $from): void
    {
        $this->_from = $from;
    }

    /*******************************************************************   METHODS   */

    /**
     * CustomMetaboxs constructor.
     * @param string $id
     * @param string $title
     * @param array $screen
     * @param string $context
     * @param string $priority
     * @param array $form
     */
    public function __construct( string $id, string $title, $screen, string $context, string $priority, array $form)
    {
        $this->setId        ( $id );
        $this->setTitle     ( $title );
        $this->setScreen    ( $screen );
        $this->setContext   ( $context );
        $this->setPriority  ( $priority );
        $this->setFrom      ( $form );
    }

    public function init()
    {
        add_meta_box($this->getId(), $this->getTitle(), array($this, 'view'), $this->getScreen(), $this->getContext(), $this->getPriority());
    }

    public function view($post)
    {
        foreach ($this->getFrom() as $item) {
            $val = get_post_meta($post->ID,$item['key'],true);
            ?>
            <label for="<?= $item['name'] ?>"><?= $item['label'] ?></label>
            <input id="<?= $item['name'] ?>" type="<?= $item['type'] ?>" name="<?= $item['name'] ?>" value="<?= $val ?>" />
            <?php
        }
    }

    public function save($postID)
    {
        foreach ($this->getFrom() as $item) {
            if(isset($_POST[$item['name'] ])){
                update_post_meta($postID,$item['key'], esc_html($_POST[$item['name'] ]));
            }
        }
    }
    public function hook()
    {
        add_action( 'add_meta_boxes', array($this, 'init') );
        add_action( 'save_post', array($this, 'save') );
    }

}