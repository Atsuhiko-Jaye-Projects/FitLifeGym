<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Workout Hover Video Demo</title>

<style>
body {
    font-family: Arial;
    background: #111;
    color: #fff;
    padding: 20px;
}

.exercise-card {
    position: relative;
    padding: 15px;
    margin-bottom: 15px;
    background: #222;
    border-radius: 8px;
    cursor: pointer;
    width: 300px;
}

.exercise-card:hover {
    background: #2a2a2a;
}

.video-preview {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    width: 320px;
    height: 180px;
    background: #000;
    z-index: 10;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 10px 20px rgba(0,0,0,0.5);
}

.exercise-card:hover .video-preview {
    display: block;
}
</style>
</head>

<body>

<h2>💪 Workout Plan</h2>

<div class="exercise-card" data-video="dQw4w9WgXcQ">
    <strong>Push-ups</strong>
    <div class="video-preview"></div>
</div>

<div class="exercise-card" data-video="3sEeVJEXTfY">
    <strong>Squats</strong>
    <div class="video-preview"></div>
</div>

<div class="exercise-card" data-video="pSHjTRCQxIw">
    <strong>Plank</strong>
    <div class="video-preview"></div>
</div>

<script>
// Attach hover video only once
document.querySelectorAll(".exercise-card").forEach(card => {
    const videoId = card.dataset.video;
    const preview = card.querySelector(".video-preview");

    card.addEventListener("mouseenter", () => {

        if (!preview.innerHTML) {
            preview.innerHTML = `
                <iframe width="320" height="180"
                    src="https://www.youtube.com/embed/${videoId}?autoplay=1&mute=1"
                    frameborder="0"
                    allow="autoplay; encrypted-media"
                    allowfullscreen>
                </iframe>
            `;
        }
    });

    // optional cleanup on leave (prevents lag over time)
    card.addEventListener("mouseleave", () => {
        // comment this if you want it to keep playing
        preview.innerHTML = "";
    });
});
</script>

</body>
</html>