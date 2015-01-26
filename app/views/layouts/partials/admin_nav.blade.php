<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
<div class="container-fluid">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
            <span class="sr-only">Toggle navigation</span>
        </button>
        <a class="navbar-brand" href="/admin">Admin Dashboard</a>
    </div>
    <div class="collapse navbar-collapse" id="navbar-collapse-01">
        <ul class="nav navbar-nav text-center">
            <li><a href="#">Inloggad som: {{Auth::user()->profile->name .' '. Auth::user()->profile->lastName}}</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="/dashboard"><span class="glyphicon glyphicon-home"></span> Till Hemsidan</a></li>
        </ul>
    </div>
    </div>
</nav>