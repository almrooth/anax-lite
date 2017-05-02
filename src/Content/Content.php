<?php

namespace Talm\Content;

class Content implements \Anax\Common\AppInjectableInterface
{
    use \Anax\Common\AppInjectableTrait;

    public function getBlock($path)
    {
        $this->app->db->connect();
        $sql = "SELECT * FROM content WHERE type=? AND path=?;";
        $res = $this->app->db->executeFetchAll($sql, ["block", $path])[0];

        $block = $this->app->textformat->format($res->data, $res->filter);

        return $block;
    }
}
