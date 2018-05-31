<?php

namespace DBlackborough\Quill\Tests\Attributes\Markdown;

require __DIR__ . '../../../../vendor/autoload.php';

use DBlackborough\Quill\Options;
use DBlackborough\Quill\Render as QuillRender;

/**
 * List tests
 */
final class ListTest extends \PHPUnit\Framework\TestCase
{
    private $delta_ordered = '{"ops":[{"insert":"Item 1"},{"attributes":{"list":"ordered"},"insert":"\n"},{"insert":"Item 2"},{"attributes":{"list":"ordered"},"insert":"\n"},{"insert":"Item 3"},{"attributes":{"list":"ordered"},"insert":"\n"}]}';
    private $delta_unordered = '{"ops":[{"insert":"Item 1"},{"attributes":{"list":"bullet"},"insert":"\n"},{"insert":"Item 2"},{"attributes":{"list":"bullet"},"insert":"\n"},{"insert":"Item 3"},{"attributes":{"list":"bullet"},"insert":"\n"}]}';

    private $expected_ordered = '1. Item 1
2. Item 2
3. Item 3
';
    private $expected_unordered = '* Item 1
* Item 2
* Item 3
';

    /**
     * Ordered list
     *
     * @return void
     * @throws \Exception
     */
    public function testListOrdered()
    {
        $result = null;

        try {
            $quill = new QuillRender($this->delta_ordered, OPTIONS::FORMAT_MARKDOWN);
            $result = $quill->render();
        } catch (\Exception $e) {
            $this->fail(__METHOD__ . 'failure, ' . $e->getMessage());
        }

        $this->assertEquals(
            $this->expected_ordered,
            $result,
            __METHOD__ . ' Ordered list failure'
        );
    }

    /**
     * Unordered list
     *
     * @return void
     * @throws \Exception
     */
    public function testListBullet()
    {
        $result = null;

        try {
            $quill = new QuillRender($this->delta_unordered, OPTIONS::FORMAT_MARKDOWN);
            $result = $quill->render();
        } catch (\Exception $e) {
            $this->fail(__METHOD__ . 'failure, ' . $e->getMessage());
        }

        $this->assertEquals(
            $this->expected_unordered,
            $result,
            __METHOD__ . ' Unordered list failure'
        );
    }
}
