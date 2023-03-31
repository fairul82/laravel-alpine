<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .active {
            color: blue;
        }
    </style>
</head>
<body>
<div x-data="{ currentTab : 'first'}">
    <button @click="currentTab = 'first'" :class="{ 'active' :currentTab === 'first'}">First</button>
    <button @click="currentTab = 'second'" :class="{ 'active' :currentTab === 'second'}">Second</button>
    <button @click="currentTab = 'third'" :class="{ 'active' :currentTab === 'third'}">Third</button>
    <div style="border: 1px dotted gray; padding: 1rem; margin-top: 1rem;">
        <div x-show="currentTab == 'first'"><p>First Tab</p></div>
        <div x-show="currentTab == 'second'"><p>Second Tab</p></div>
        <div x-show="currentTab == 'third'"><p>Third Tab</p></div>
    </div>
</div>
</body>
</html>
