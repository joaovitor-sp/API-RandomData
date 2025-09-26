@extends('layouts.index')

@section('body')
@if ($isStaticPage)
<div class="d-flex justify-content-center mb-2">
    <button type="button" onclick="addPersonDetail()" class="button-add" data-bs-toggle="modal" data-bs-target="#detail">
        <div class="px-2"> Add Person <i class="fa-solid fa-plus"></i> </div>
    </button>
</div>
@endif
<div class="card-container">
    @foreach($people as $person)
    <div class="person-card">
        <img src="{{ $person->avatar }}" alt="{{ $person->first_name }} {{ $person->last_name }}">
        <div>
            <h1 class="title">{{ $person->first_name }} {{ $person->last_name }}</h1>
            <h2 class="subtitle">{{ $person->email }}</h2>
            <span class="description">{{ $person->gender }}</span>
            <button type="button" onclick="getPersonDetail('{{ $person->uid }}')" class="button-card" data-bs-toggle="modal" data-bs-target="#detail">
                Show Details
            </button>
        </div>
    </div>
    @endforeach
</div>
<!-- Modal -->
<div class="modal fade" id="detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="modal-body" class="modal-body text-start">
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-footer-modal" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    const peoples = @json($people);

    function getPersonDetail(uid) {
        const modalBody = document.querySelector('#modal-body');
        const person = peoples.find(person => person.uid = uid);
        modalBody.innerHTML = '';
        @if($isStaticPage)
        const modalFooter = document.querySelector('.modal-footer');
        modalFooter.innerHTML = `
        <button onclick="deletePerson(${person.id})" class="btn btn-primary" data-bs-dismiss="modal">Deletar</button>
        <button type="button" id="btn-footer-modal" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
        `;
        @endif

        modalBody.innerHTML = `
        <p><b>uid:</b> ${person.uid}</p>
        <p><b>password:</b> ${person.password}</p>
        <p><b>first_name:</b> ${person.first_name}</p>
        <p><b>last_name:</b> ${person.last_name}</p>
        <p><b>username:</b> ${person.username}</p>
        <p><b>email:</b> ${person.email}</p>
        <p><b>avatar:</b> ${person.avatar}</p>
        <p><b>gender:</b> ${person.gender}</p>
        <p><b>phone_number:</b> ${person.phone_number}</p>
        <p><b>date_of_birth:</b> ${person.date_of_birth}</p>
        `;
    }

    function addPersonDetail() {
        const modalBody = document.querySelector('#modal-body');
        const modalFooter = document.querySelector('.modal-footer');
        modalFooter.innerHTML = `
        <button type="submit" onclick="submitForm()" class="btn btn-primary">Enviar</button>
        `;

        modalBody.innerHTML = `
        <form id="addPerson" action="{{ route('add-person') }}" method="post">
        @csrf
        <h5><b>por favor complete todos os campos para poder enviar o formulário</b></h5>
        <p><b>uid:</b></p> 
        <input type="text" name="uid" id="uid" required></input>
        <p><b>password:</b></p> 
        <input type="text" name="password" id="password" required></input>
        <p><b>first_name:</b></p> 
        <input type="text" name="first_name" id="first_name" required></input>
        <p><b>last_name:</b></p> 
        <input type="text" name="last_name" id="last_name" required></input>
        <p><b>username:</b></p> 
        <input type="text" name="username" id="username" required></input>
        <p><b>email:</b></p> 
        <input type="text" name="email" id="email" required></input>
        <p><b>avatar(image link):</b></p> 
        <input type="text" name="avatar" id="avatar" required></input>
        <p><b>gender:</b></p> 
        <input type="text" name="gender" id="gender" required></input>
        <p><b>phone_number:</b></p> 
        <input type="text" name="phone_number" id="phone_number" required></input>
        <p><b>date_of_birth:</b></p> 
        <input type="text" name="date_of_birth" id="date_of_birth" required></input>
        </form>
        `;
    }

    function submitForm() {
        const form = document.getElementById('addPerson');
        const inputs = form.querySelectorAll('input');
        let valido = true;
        try {
            inputs.forEach(input => {
                if (!input.value) {
                    alert(`O campo ${input.name} é obrigatório`);
                    valido = false;
                    throw new Error('Parando o loop');
                }
            });
        } catch (error) {}

        if (valido) {
            document.getElementById('addPerson').submit()
        }


    }

    function deletePerson(id) {
        fetch('/remove-person/' + id, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
            })
            .then(response => {
                if (response.ok) {
                    window.location.reload();
                } else {
                    console.error("Erro ao deletar:", response.status);
                }
            })
            .catch(error => console.error("Erro:", error));
    }
</script>
@endsection