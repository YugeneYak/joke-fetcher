<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Joke;

class FetchJokesCommand extends Command
{
    protected $signature = 'jokes:fetch';
    protected $description = 'Fetch random joke from official-joke-api and save to DB';

    public function handle()
    {
        $response = Http::get('https://official-joke-api.appspot.com/random_joke');

        if ($response->successful()) {
            $data = $response->json();

            Joke::updateOrCreate(
                ['api_id' => $data['id']],
                [
                    'type'      => $data['type'] ?? null,
                    'setup'     => $data['setup'],
                    'punchline' => $data['punchline'],
                ]
            );

            $this->info('Joke saved: ' . $data['setup']);
        } else {
            $this->error('Failed to fetch joke');
        }
    }
}
