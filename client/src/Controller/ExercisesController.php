<?php

namespace Wspomagacz\Client\Controller;

use Wspomagacz\Client\Model\Exercise;
use Wspomagacz\Client\View\View;

class ExercisesController
{
    /**
     * @var array
     */
    public array $exercises = [];

    /**
     * @var array
     */
    public array $customExercises = [];

    /**
     * @return void
     */
    public function index(): void
    {
        $view = new View(__DIR__ . '/../View/Exercises');
        $view->render('index', [], 'Wspomagacz | Ćwiczenia');
    }

    /**
     * @return void
     */
    private function setExercises(): void
    {
        //TODO: fetch Exercises from API

        // API endpoint URL
        $apiUrl = 'https://api.example.com/data';

        // Initialize cURL session
        $ch = curl_init($apiUrl);

        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string instead of outputting it

        // Execute cURL session and get the response
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        }

        // Close cURL session
        curl_close($ch);

        // Process the API response (e.g., decode JSON)
        $data = json_decode($response, true);

        // Check if decoding was successful
        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            echo 'Error decoding JSON: ' . json_last_error_msg();
        } else {
            // Process the data
            foreach($data as $exercise) {
                $exercise = new Exercise();
            }
        }
    }

    /**
     * @param Exercise $exercise
     * @return void
     */
    private function addCustomExercise(Exercise $exercise): void
    {
        $this->customExercises[] = $exercise;
    }

    private function pushCustomExercises(): void
    {
        //TODO: Send Custom User Exercises to API
    }

    /**
     * @return array
     */
    public function getExercises(): array
    {
        return $this->exercises;
    }

    /**
     * @return array
     */
    public function getCustomExercises(): array
    {
        return $this->customExercises;
    }
}