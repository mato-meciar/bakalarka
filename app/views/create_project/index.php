<div class="container">
    <h2>Vytvorenie projektu</h2>
    <div class="well">
        <form method="post" role="form" id="createProjectForm">
            <div class="form-group">
                <label for="name">Nazov projektu</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group">
                <label for="details">Popis projektu</label>
                <textarea class="form-control" rows="5" name="details" required></textarea>
            </div>
            <div class="form-group">
                <label for="domain">Oblast projektu</label>
                <div>
                    <input type="text" class="form-control tm-input-domain" id="domain">
                </div>
            </div>
            <div class="form-group">
                <label for="platform">Platforma projektu</label><br>
                <div>
                    <input type="text" class="form-control tm-input-platform" id="platform">
                </div>
            </div>
            <div class="form-group">
                <label for="technologies">Technologie projektu</label><br>
                <div>
                    <input type="text" class="form-control tm-input-technologies" id="technologies">
                </div>
            </div>
            <div>
                <input type="submit" class="btn btn-primary" value="Postupit projekt na schvalovanie">
            </div>
        </form>
    </div>
</div>

<script>
    jQuery(".tm-input-domain").tagsManager({hiddenTagListName: 'domain', delimiters: [44, 13]});
    jQuery(".tm-input-platform").tagsManager({hiddenTagListName: 'platform', delimiters: [44, 13]});
    jQuery(".tm-input-technologies").tagsManager({hiddenTagListName: 'technologies', delimiters: [44, 13]});
</script>
