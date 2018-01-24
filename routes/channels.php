<?php

Broadcast::channel('chat', function () {
    return auth()->check();
});