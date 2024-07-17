@extends('layouts.admin')

@section('content')
    <div class="container mt10vh">
        <!-- Pulsante Indietro -->
        <a class="btn btn-primary mt-3 mb-3" href="{{ route('admin.flats.index') }}">
            <i class="fa-solid fa-arrow-left"></i> Torna Indietro
        </a>

        <div class="row text-center">
            <div class="col-12 my-4">
                <h4>Aggiungi Nuovo Appartamento</h4>
            </div>

            <form action="{{ route('admin.flats.store') }}" method="post" class="mb-3" enctype="multipart/form-data">
                @csrf

                <div class="container">
                    <div class="row">
                        {{-- title --}}
                        <div class="col-12">
                            <div class="form-floating mb-3">

                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" placeholder="Inserisci Titolo" required
                                    value="{{ old('title') }}">
                                <label for="title">Inserisci Titolo *
                                    @error('title')
                                        - {{ $errors->get('title')[0] }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        {{-- max_guests --}}
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">

                                <input type="number" class="form-control @error('max_guests') is-invalid @enderror"
                                    id="max_guests" name="max_guests" placeholder="Numero Ospiti" required
                                    value="{{ old('max_guests') }}">
                                <label for="max_guests">Numero Ospiti *
                                    @error('max_guests')
                                        - {{ $errors->get('max_guests')[0] }}
                                    @enderror
                                </label>

                            </div>
                        </div>

                        {{-- rooms --}}
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control @error('rooms') is-invalid @enderror"
                                    id="rooms" name="rooms" placeholder="Numero Stanze" min="1" required
                                    value="{{ old('rooms') }}">
                                <label for="rooms">Numero Stanze *
                                    @error('rooms')
                                        - {{ $errors->get('rooms')[0] }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        {{-- beds --}}
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control @error('beds') is-invalid @enderror"
                                    id="beds" name="beds" placeholder="Numero Letti" min="1" required
                                    value="{{ old('beds') }}">
                                <label for="beds">Numero Letti *
                                    @error('beds')
                                        - {{ $errors->get('beds')[0] }}
                                    @enderror
                                </label>

                            </div>
                        </div>

                        {{-- bathrooms --}}
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">

                                <input type="number" class="form-control @error('bathrooms') is-invalid @enderror"
                                    id="bathrooms" name="bathrooms" placeholder="Numero Bagni" min="1" required
                                    value="{{ old('bathrooms') }}">
                                <label for="bathrooms">Numero Bagni *
                                    @error('bathrooms')
                                        - {{ $errors->get('bathrooms')[0] }}
                                    @enderror
                                </label>

                            </div>
                        </div>

                        {{-- meters_square --}}
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control @error('meters_square') is-invalid @enderror"
                                    id="meters_square" name="meters_square" placeholder="Metri quadrati" min="5"
                                    required value="{{ old('meters_square') }}">
                                <label for="meters_square">Metri quadrati *
                                    @error('meters_square')
                                        - {{ $errors->get('meters_square')[0] }}
                                    @enderror
                                </label>

                            </div>
                        </div>

                        {{-- visible --}}
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select @error('visible') is-invalid @enderror" id="visible" name="visible" aria-label="Visibile">
                                    <option value="si" @selected(old('visible') == 'si')>Sì</option>
                                    <option value="no" @selected(old('visible') == 'no')>No</option>
                                </select>

                                <label for="visible">Visibile *
                                    @error('visible')
                                        - {{ $errors->get('visible')[0] }}
                                    @enderror
                                </label>

                            </div>
                        </div>

                        <!-- Indirizzo -->
                        <div class="col-12">
                            <div class="form-floating mb-3">

                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    id="address" name="address" placeholder="Indirizzo" min="5" required
                                    value="{{ old('address') }}">
                                <label for="address">Indirizzo *
                                    @error('address')
                                        - {{ $errors->get('address')[0] }}
                                    @enderror
                                </label>

                                <div id="dropdown" class="dropdown-content"></div>
                            </div>
                        </div>


                        {{-- description --}}
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Inserisci descrizione"
                                    name="description" style="height: 100px">{{ old('description') }}</textarea>
                                <label for="description">Descrizione *
                                    @error('description')
                                        - {{ $errors->get('description')[0] }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        {{-- services --}}
                        <div class="col-12">
                            <div class="modal-services mb-3">
                                <h6>
                                    Seleziona i servizi
                                </h6>
                                <div class="container">
                                    <div class="row wrapper-check justify-content-center g-1">
                                        @foreach ($services as $service)
                                            <div class="col-6 col-lg-3">
                                                <input type="checkbox" name="services[]" class="check-service"
                                                    id="service-{{ $service->id }}" value="{{ $service->id }}" @checked(in_array($service->id, old('services', []))) >
                                                <label for="service-{{ $service->id }}">
                                                    <img src="{{ asset('storage/services/' . $service->icon) }}"
                                                        alt="Icona {{ $service->name }}">
                                                    {{ $service->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>


                        {{-- main_img --}}
                        <div class="col-12 mb-3">
                            <div class="ms_border">

                                <label for="main_img" class="mb-1">Inserisci foto principale: *</label>
                                <input type="file" class="form-control mb-3 ms_file @error('main_img') is-invalid @enderror"
                                    id="main_img" placeholder="inserici immagine" name="main_img" accept=".jpg,.webp,.png,.svg,.bmp,.heic"
                                    value="{{ old('main_img') }}">
    
                                @error('main_img')
                                    <div class="alert alert-danger">
                                        {{ $errors->get('main_img')[0] }}
                                    </div>
                                @enderror
    
                                <img id="anteprima-immagine" class="img-fluid d-block w-25 m-auto mb-3" src="">
                            </div>
                        </div>

                        {{-- gallery photo --}}
                        <div class="col-12mb-3">
                            <div class="ms_border">
                                <label for="photos" class="mb-1">Inserisci foto aggiuntive:</label>
                                <input type="file" multiple class="form-control mb-3 ms_file @error('photos') is-invalid @enderror"
                                    id="photos" placeholder="inserici immagine" name="photos[]" accept=".jpg,.webp,.png,.svg,.bmp,.heic"
                                    value="{{ old('photos') }}">
    
                                @error('photos')
                                    <div class="alert alert-danger">
                                        {{ $errors->get('photos')[0] }}
                                    </div>
                                @enderror
    
                                <div id="gallery-preview" class="mb-3">
    
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Script per anteprima immagini -->
    <script>
        document.getElementById('main_img').addEventListener('change', function(event) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('anteprima-immagine').src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        });

        document.getElementById('photos').addEventListener('change', function(event) {
            const galleryPreview = document.getElementById('gallery-preview');
            galleryPreview.innerHTML = '';
            Array.from(event.target.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function() {
                    const img = document.createElement('img');
                    img.src = reader.result;
                    img.classList.add('img-fluid', 'm-2');
                    img.style.maxWidth = '150px';
                    galleryPreview.appendChild(img);
                }
                reader.readAsDataURL(file);
            });
        });
    </script>
@endsection
