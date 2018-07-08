<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Representations;

use progpilot\Code\Opcodes;

class ControlFlowGraph
{
    private $nodes;
    private $edges;
    private $myblock_text;

    public function __construct()
    {
        $this->nodes = [];
        $this->edges = [];
        $this->myblock_text = [];
    }

    public function getTextOfMyBlock($id)
    {
        if (isset($this->myblock_text["$id"])) {
            return $this->myblock_text["$id"];
        }

        return "";
    }

    public function addTextOfMyBlock($id, $text)
    {
        if (isset($this->myblock_text["$id"])) {
            $this->myblock_text["$id"] = $this->myblock_text["$id"]."$text";
        } else {
            $this->myblock_text["$id"] = "$text";
        }
    }

    public function getNodes()
    {
        return $this->nodes;
    }

    public function getEdges()
    {
        return $this->edges;
    }

    public function addNode($id, $block)
    {
        $this->nodes["$id"] = $block;
    }

    public function getIdOfNode($block)
    {
        foreach ($this->nodes as $id => $block_tmp) {
            if ($block === $block_tmp) {
                return $id;
            }
        }

        return -1;
    }

    public function addEdge($caller, $callee)
    {
        $this->edges[] = [$caller, $callee];
    }
}
