</div>
</div>

</body>
</html>
<script>
    function toggleMenu() {
        document.getElementById("menuDropdown").classList.toggle("show");

        let arrow = document.getElementById("arrow");
        if (arrow.innerHTML === "▾") {
            arrow.innerHTML = "▴";
        } else {
            arrow.innerHTML = "▾";
        }
    }
</script>
