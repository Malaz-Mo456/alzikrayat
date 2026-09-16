<?php

/**
 * Test Controller
 *
 * Used to test the custom Router.
 */
class TestController
{
    /**
     * Tests a simple route.
     *
     * @return void
     */
    public function index()
    {
        echo "Router is working!";
    }

    /**
     * Tests a route with a dynamic parameter.
     *
     * @param string $id The ID received from the URL.
     * @return void
     */
    public function show($id)
    {
        echo "Router is working! ID = " . htmlspecialchars($id);
    }
}