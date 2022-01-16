<div class="card shadow">
    <div class="card-img-top bg-blur-img" style="height: 160px; width: 100%; background-image: linear-gradient( rgba(0, 0, 0, 0.4) 100%, rgba(0, 0, 0, 0.4)100%), url('{{ session('UserSession')['profil']['photo'] ?? '' }}');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        background-color: rgba(0,0,0, 0.4);">
    </div>
    <div
        style=" position: absolute; top: 41px;  border: none!important; background: transparent!important; width: 100%; display: flex; justify-content: center">
        <img src="{{ session('UserSession')['profil']['photo'] ?? '' }}" class="img-fluid img-thumbnail" id="photo_vue"
            style="border-radius: 58px; width: 100px; height: 100px;">
    </div>
</div>