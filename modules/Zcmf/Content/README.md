Content Module
===
This module enables to create basic pages with texts, contact forms and media
items. The pages are all static and do not have any subpages whatsoever. Pages
can contain multiple blocks of content, for example a text and form or two text
blocks for a left and right column.

The pages are devided into types which can be set in the module.config.php:

    $types   = array(
        'standard' => array(
            'text' => 'Text',
        ),
        'twocolumn' => array(
            'left' => 'Text',
            'right' => 'Text',
        ),
        'contact' => array(
            'text' => 'Text',
            'form' => 'Form',
        ),
    );

The key => value mapping is an identifier (the key) and a type of content (value).
All values map to entities in the namespace Zcmf\Content\Model\Item. For example
the contact type has a text under the key "text" and a form under "form". To render
this page, a contact.phtml view script is created (the name of the type equals the
name of the view script). Inside this view script, the blocks are available with
the key name as variable name:

    <article>
        <?= $this->text($text)?>
        <?= $this->form($form)?>
    </article>

Here $text and $form are respectively Zcmf\Content\Model\Item\Text and 
Zcmf\Content\Model\Item\Form instances. The view helpers $this->text() and 
$this->form() are available to render the entities. A text view helper is simply 
doing this:

    public function __invoke(Text $text)
    {
        return $text->getBody();
    }

Of course more complicated blocks (like images, video's, galleries) can be created
in a similar fashion.