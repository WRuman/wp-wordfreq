<?php
/*
  Plugin Name: Post Word Frequency Analyzer
  Version: 0.1.0
  Author: Will Ruman
  License: MIT
*/

class WordFreqAnalyzer {
  public static function getTopWord($text) {
    $wordList = explode(' ', strip_tags($text));
    // Store words and their counts as key -> value pairs
    $counts = array();
    foreach($wordList as $word) {
      $word = strtolower($word);
      // Check if word is already stored with a count
      if(isset($counts[$word])) {
        // Increment the count if the word is found
        $counts[$word]++;
      } else {
        // Store the word with a count of 1 if not found
        $counts[$word] = 1;
      }
    }
    $max = 0;
    $top = '';
    // Check each word -> count pair to find the highest count
    foreach($counts as $word => $count) {
	  if($count > $max) {
        $max = $count;
        $top = $word;
      }
    }
    // Add a trailing <p> with word count information
    return  $text . '<p>Most used word in this post: <strong>"' . $top . '"</strong>, used ' . $max . ' times.</p>';
  }
}

add_filter('the_content', array('WordFreqAnalyzer', 'getTopWord'));

?>