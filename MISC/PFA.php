<?php
require_once("debug.php");
/**
 * @author    Greg Roach <greg@subaqua.co.uk>
 * @copyright (c) 2015 Greg Roach <greg@subaqua.co.uk>
 * @license   GPL-3.0+
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Class Dijkstra - Use Dijkstra's algorithm to calculate the shortest path
 * through a weighted, directed graph.
 */
class Dijkstra
{
    /** @var integer[][] The graph, where $graph[node1][node2]=cost */
    protected $graph;

    /** @var int[] Distances from the source node to each other node */
    protected $distance;

    /** @var string[][] The previous node(s) in the path to the current node */
    protected $previous;

    /** @var int[] Nodes which have yet to be processed */
    protected $queue;

    /**
     * @param integer[][] $graph
     */
    public function __construct($graph)
    {
        $this->graph = $graph;
    }

    /**
     * Process the next (i.e. closest) entry in the queue.
     *
     * @param string[] $exclude A list of nodes to exclude - for calculating next-shortest paths.
     *
     * @return void
     */
    protected function processNextNodeInQueue(array $exclude)
    {
        // Process the closest vertex
        $closest = array_search(min($this->queue), $this->queue);
        if (!empty($this->graph[$closest]) && !in_array($closest, $exclude)) {
            foreach ($this->graph[$closest] as $neighbor => $cost) {
                if (isset($this->distance[$neighbor])) {
                    if ($this->distance[$closest] + $cost < $this->distance[$neighbor]) {
                        // A shorter path was found
                        $this->distance[$neighbor] = $this->distance[$closest] + $cost;
                        $this->previous[$neighbor] = array($closest);
                        $this->queue[$neighbor] = $this->distance[$neighbor];
                    } elseif ($this->distance[$closest] + $cost === $this->distance[$neighbor]) {
                        // An equally short path was found
                        $this->previous[$neighbor][] = $closest;
                        $this->queue[$neighbor] = $this->distance[$neighbor];
                    }
                }
            }
        }
        unset($this->queue[$closest]);
    }

    /**
     * Extract all the paths from $source to $target as arrays of nodes.
     *
     * @param string $target The starting node (working backwards)
     *
     * @return string[][] One or more shortest paths, each represented by a list of nodes
     */
    protected function extractPaths($target)
    {
        $paths = array(array($target));

        for ($key = 0; isset($paths[$key]); ++$key) {
            $path = $paths[$key];

            if (!empty($this->previous[$path[0]])) {
                foreach ($this->previous[$path[0]] as $previous) {
                    $copy = $path;
                    array_unshift($copy, $previous);
                    $paths[] = $copy;
                }
                unset($paths[$key]);
            }
        }

        return array_values($paths);
    }

    /**
     * Calculate the shortest path through a a graph, from $source to $target.
     *
     * @param string   $source  The starting node
     * @param string   $target  The ending node
     * @param string[] $exclude A list of nodes to exclude - for calculating next-shortest paths.
     *
     * @return string[][] Zero or more shortest paths, each represented by a list of nodes
     */
    public function shortestPaths($source, $target, array $exclude = array())
    {
        // The shortest distance to all nodes starts with infinity...
        $this->distance = array_fill_keys(array_keys($this->graph), INF);
        // ...except the start node
        $this->distance[$source] = 0;

        // The previously visited nodes
        $this->previous = array_fill_keys(array_keys($this->graph), array());

        // Process all nodes in order
        $this->queue = array($source => 0);
        while (!empty($this->queue)) {
            $this->processNextNodeInQueue($exclude);
        }

        if ($source === $target) {
            // A null path
            return array(array($source));
        } elseif (empty($this->previous[$target])) {
            // No path between $source and $target
            return array();
        } else {
            // One or more paths were found between $source and $target
            return $this->extractPaths($target);
        }
    }
}

/*$graph = array
(
    "checkIn_0_ZUzC6" => array
        (
            "securityCheck_0_m6TV9" => 1
        ),

    "checkIn_1_5srKM" => array
        (
            "securityCheck_1_NwnDx" => 1
        ),

    "securityCheck_0_m6TV9" => array
        (
            "junction_0_A6wvf" => 1
        ),

    "securityCheck_1_NwnDx" => array
        (
            "junction_1_URLk5" => 1
        ),

    "junction_0_A6wvf" => array
        (
            "junction_1_URLk5" => 1,
            "junction_2_s0RW6" => 1
        ),

    "junction_1_URLk5" => array
        (
            "junction_0_A6wvf" => 1,
            "junction_3_jSv6s" => 1
        ),

    "junction_2_s0RW6" => array
        (
            "junction_3_jSv6s" => 1,
            "gate_0_5nLYQ" => 1
        ),

    "junction_3_jSv6s" => array
        (
            "junction_2_s0RW6" => 1,
            "gate_1_lj7Ds" => 1
        ),

    "gate_0_5nLYQ" => array
        (
            "0" => 1,
            "collectionCarousel0_WWok0" => 1
        ),

    "gate_1_lj7Ds" => array
        (
            "1" => 1,
            "collectionCarousel1_yIhfa" => 1
        ),

    "collectionCarousel0_WWok0" => array
        (
            "exitGate0_TfWD7" => 1
        ),

    "collectionCarousel1_yIhfa" => array
        (
            "exitGate0_TfWD7" => 1
        ),

      "0" => array
      (

      ),

      "1" => array
      (

      )
);*/

/*$graph = array
(
    "fEImLye" => array
        (
            "checkIn_0_x5xBg" => 1,
            "checkIn_1_AObja" => 1
        ),

    "checkIn_0_x5xBg" => array
        (
            "securityCheck_0_IWvu8" => 1
        ),

    "checkIn_1_AObja" => array
        (
            "securityCheck_1_9ZibG" => 1
        ),

    "securityCheck_0_IWvu8" => array
        (
            "junction_0_pBlRh" => 1
        ),

    "securityCheck_1_9ZibG" => array
        (
            "junction_1_vZpGr" => 1
        ),

    "junction_0_pBlRh" => array
        (
            "junction_1_vZpGr" => 1,
            "junction_2_UxxT0" => 1
        ),

    "junction_1_vZpGr" => array
        (
            "junction_0_pBlRh" => 1,
            "junction_3_tPrfi" => 1
        ),

    "junction_2_UxxT0" => array
        (
            "junction_3_tPrfi" => 1,
            "gate_0_aoxwP" => 1
        ),

    "junction_3_tPrfi" => array
        (
            "junction_2_UxxT0" => 1,
            "gate_1_wRjZS" => 1
        ),

    "gate_0_aoxwP" => array
        (
            "plane_0_66ned" => 1,
            "collectionCarousel0_VQ9uf" => 1
        ),

    "gate_1_wRjZS" => array
        (
            "plane_1_XItBH" => 1,
            "collectionCarousel1_mEgMN" => 1
        ),

    "collectionCarousel0_VQ9uf" => array
        (
            "exitGate0_CZBdl" => 1
        ),

    "collectionCarousel1_mEgMN" => array
        (
            "exitGate0_CZBdl" => 1
        ),

    "plane_0_66ned" => array
        (
            "gate_0_XlBrE" => 1
        ),

    "plane_1_XItBH" => array
        (
            "gate_1_1IDLt" => 1
        ),

    "YTroh8J" => array
        (
            "checkIn_0_snpxQ" => 1,
            "checkIn_1_NndKE" => 1
        ),

    "checkIn_0_snpxQ" => array
        (
            "securityCheck_0_8tTQ3" => 1
        ),

    "checkIn_1_NndKE" => array
        (
            "securityCheck_1_yZtJh" => 1
        ),

    "securityCheck_0_8tTQ3" => array
        (
            "junction_0_rrj8L" => 1
        ),

    "securityCheck_1_yZtJh" => array
        (
            "junction_1_cxiVE" => 1
        ),

    "junction_0_rrj8L" => array
        (
            "junction_1_cxiVE" => 1,
            "junction_2_P4pK6" => 1
        ),

    "junction_1_cxiVE" => array
        (
            "junction_0_rrj8L" => 1,
            "junction_3_sVVyA" => 1
        ),

    "junction_2_P4pK6" => array
        (
            "junction_3_sVVyA" => 1,
            "gate_0_XlBrE" => 1
        ),

    "junction_3_sVVyA" => array
        (
            "junction_2_P4pK6" => 1,
            "gate_1_1IDLt" => 1
        ),

    "gate_0_XlBrE" => array
        (
            "plane_0_8Tw16" => 1,
            "collectionCarousel0_vXWUS" => 1
        ),

    "gate_1_1IDLt" => array
        (
            "plane_1_SgNgj" => 1,
            "collectionCarousel1_zNawx" => 1
        ),

    "collectionCarousel0_vXWUS" => array
        (
            "exitGate0_vvBEn" => 1
        ),

    "collectionCarousel1_zNawx" => array
        (
            "exitGate0_vvBEn" => 1
        ),

    "plane_0_8Tw16" => array
        (
            "gate_0_aoxwP" => 1
        ),

    "plane_1_SgNgj" => array
        (
            "gate_1_wRjZS" => 1
        )

);*/

/*
$d = new Dijkstra($graph);
debugVar($d->shortestPaths("fEImLye", "exitGate0_vvBEn"));
*/
?>
