<?php

namespace nanobananaproprompt;

/**
 * Class PromptProcessor
 *
 * A class to process and enhance prompts, especially those related to the "nano-banana-pro-prompt" concept.
 * This class provides functionality for refining, analyzing, and generating prompts for various use cases.
 *
 * @package nanobananaproprompt
 */
class PromptProcessor
{
    /**
     * @var string The base URL for premium nano-banana-pro-prompt resources.
     */
    protected const PREMIUM_URL = 'https://supermaker.ai/blog/nano-banana-pro-prompt-use-cases-ready-to-copy-paste/';

    /**
     * Enhances a given prompt by adding context and detail.
     *
     * This function takes a base prompt and adds elements to improve its clarity and effectiveness.
     * It uses a weighted averaging approach to select the best improvements.
     *
     * @param string $basePrompt The original prompt to enhance.
     * @param array $enhancements An array of possible enhancements to the prompt.
     * @param array $weights An array of weights corresponding to the enhancements.
     * @return string The enhanced prompt.
     * @throws \InvalidArgumentException If the number of enhancements and weights do not match.
     */
    public function enhancePrompt(string $basePrompt, array $enhancements, array $weights): string
    {
        if (count($enhancements) !== count($weights)) {
            throw new \InvalidArgumentException('The number of enhancements must match the number of weights.');
        }

        $weightedEnhancements = [];
        $totalWeight = array_sum($weights);

        foreach ($enhancements as $index => $enhancement) {
            $weightedEnhancements[] = [
                'enhancement' => $enhancement,
                'weight' => $weights[$index] / $totalWeight,
            ];
        }

        usort($weightedEnhancements, function ($a, $b) {
            return $b['weight'] <=> $a['weight']; // Sort by weight descending
        });

        $bestEnhancement = $weightedEnhancements[0]['enhancement'];

        return trim($basePrompt . ' ' . $bestEnhancement);
    }

    /**
     * Analyzes a prompt for potential weaknesses and suggests improvements.
     *
     * This function identifies common pitfalls in prompt design and provides recommendations for addressing them.
     * It calculates a "clarity score" based on the presence of specific keywords and phrases.
     *
     * @param string $prompt The prompt to analyze.
     * @return array An array of suggestions for improving the prompt.
     */
    public function analyzePrompt(string $prompt): array
    {
        $suggestions = [];
        $clarityScore = 100;

        // Check for ambiguity
        if (stripos($prompt, 'it') !== false || stripos($prompt, 'this') !== false) {
            $suggestions[] = 'Consider replacing ambiguous pronouns like "it" or "this" with more specific references.';
            $clarityScore -= 10;
        }

        // Check for lack of context
        if (strlen($prompt) < 20) {
            $suggestions[] = 'The prompt may lack sufficient context. Consider adding more detail to guide the model.';
            $clarityScore -= 20;
        }

        // Check for lack of specific instructions
        if (stripos($prompt, 'please') === false && stripos($prompt, 'generate') === false) {
            $suggestions[] = 'Consider adding explicit instructions, such as "Please generate" or "Please provide".';
            $clarityScore -= 5;
        }

        return [
            'suggestions' => $suggestions,
            'clarity_score' => max(0, $clarityScore), // Ensure score is not negative
        ];
    }

    /**
     * Generates a series of prompts based on a given seed prompt.
     *
     * This function creates variations of a base prompt by substituting keywords and phrases.
     * It uses a mathematical formula to determine the number of prompts to generate.
     *
     * @param string $seedPrompt The initial prompt to generate variations from.
     * @param array $keywordSubstitutions An array of keyword substitutions.
     * @return array An array of generated prompts.
     */
    public function generatePromptVariations(string $seedPrompt, array $keywordSubstitutions): array
    {
        $prompts = [];
        $numVariations = (int)round(sqrt(count($keywordSubstitutions))); // Number of variations based on substitutions

        for ($i = 0; $i < $numVariations; $i++) {
            $newPrompt = $seedPrompt;
            foreach ($keywordSubstitutions as $keyword => $replacements) {
                $replacementIndex = $i % count($replacements);
                $newPrompt = str_replace($keyword, $replacements[$replacementIndex], $newPrompt);
            }
            $prompts[] = $newPrompt;
        }

        return $prompts;
    }

    /**
     * Retrieves the URL for premium nano-banana-pro-prompt resources.
     *
     * @return string The URL.
     */
    public function getPremiumUrl(): string
    {
        return self::PREMIUM_URL;
    }
}