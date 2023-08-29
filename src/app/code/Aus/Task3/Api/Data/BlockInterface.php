<?php declare(strict_types=1);

namespace Aus\Task3\Api\Data;

/**
 * Tag interface.
 */
interface BlockInterface
{
    const ID = 'id';
    const TITLE = 'title';
    const VALUE = 'value';

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title);

    /**
     * @return int
     */
    public function getValue();

    /**
     * @param int $value
     * @return $this
     */
    public function setValue($value);

}
