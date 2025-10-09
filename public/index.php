<?php
// ফাইল: index.php

// API-এর জন্য কিছু সাধারণ হেডার সেট করছি। এগুলো ব্রাউজারকে বলে দেয়
// যে কোনো ডোমেইন থেকে এই API ব্যবহার করা যাবে এবং ডেটা JSON ফরম্যাটে আসবে।
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// এখন আমাদের রুট ম্যাপ বা রাউটার ফাইলটিকে যুক্ত করছি।
// এরপর বাকি সব কাজ রাউটারই পরিচালনা করবে।
require_once __DIR__ . '/routes/api-endpoints.php';