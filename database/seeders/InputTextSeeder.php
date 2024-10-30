<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InputText;
use Illuminate\Support\Facades\File;
use GuzzleHttp\Client;

class InputTextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePaths = [database_path('seeders/SE systemenjinia no Nyuu Mon Sh - Kan Gen  Bun Zou.txt')];

        foreach ($filePaths as $filePath) {
            if (File::exists($filePath)) {
                $content = File::get($filePath);

                $inputText = InputText::updateOrCreate(['content' => $content], ['content' => $content]);

                $this->analyzeTextAndPopulateFrequencies($inputText);
            } else {
                echo "File not found at: $filePath";
            }
        }
    }

    /**
     * Call the API to analyze text and populate word frequencies
     */
    private function analyzeTextAndPopulateFrequencies(InputText $inputText)
    {
        $client = new Client();
        try {
            $response = $client->post('http://localhost:5000/analyze', [
                'json' => ['content' => $inputText->content],
            ]);

            $data = json_decode($response->getBody(), true);

            foreach ($data['frequencies'] as $word => $frequency) {
                $existingWord = \App\Models\WordFrequency::where('word', $word)->first();

                if ($existingWord) {
                    $existingWord->update([
                        'frequency' => $existingWord->frequency + $frequency,
                    ]);
                } else {
                    \App\Models\WordFrequency::create([
                        'input_text_id' => $inputText->id,
                        'word' => $word,
                        'frequency' => $frequency,
                    ]);
                }
            }
        } catch (\Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
