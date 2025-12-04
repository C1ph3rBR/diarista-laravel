<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Serviço de Diarista - Orçamento Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body { font-family: Arial, sans-serif; background: #f7fafc; margin: 0; }
        header { background: #2563eb; color: #fff; padding: 20px; text-align: center; }
        .container { max-width: 900px; margin: 30px auto; background: #fff; border-radius: 8px;
            padding: 25px; box-shadow: 0 0 15px rgba(0,0,0,0.05); }
        .intro { margin-bottom: 20px; color: #4b5563; }
        .alert-success { background: #dcfce7; border: 1px solid #22c55e; color: #166534;
            padding: 10px 15px; border-radius: 6px; margin-bottom: 15px; }
        .alert-error { background: #fee2e2; border: 1px solid #ef4444; color: #991b1b;
            padding: 10px 15px; border-radius: 6px; margin-bottom: 15px; }
        form { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px 20px; }
        .full { grid-column: 1 / -1; }
        label { display: block; margin-bottom: 4px; font-weight: 600; color: #374151; }
        input, select, textarea {
            width: 100%; padding: 8px 10px; border-radius: 6px; border: 1px solid #d1d5db;
            box-sizing: border-box;
        }
        textarea { min-height: 80px; resize: vertical; }
        .checkbox-group { display: flex; align-items: center; gap: 8px; margin-top: 4px; }
        button[type="submit"] {
            background: #2563eb; color: #fff; border: none; padding: 12px 20px;
            border-radius: 8px; font-size: 16px; cursor: pointer;
        }
        button[type="submit"]:hover { background: #1d4ed8; }
        footer { text-align: center; padding: 15px; color: #6b7280; font-size: 14px; }
    </style>
</head>
<body>
<header>
    <h1>Diarista Profissional</h1>
    <p>Solicite seu orçamento online de forma rápida.</p>
</header>

<div class="container">
    <div class="intro">
        <p>Atendemos casas, apartamentos e escritórios com diaristas selecionadas.</p>
        <p>Preencha o formulário para se cadastrar e receber um orçamento personalizado.</p>
    </div>

    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert-error">
            <strong>Ops! Verifique os campos abaixo:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h2>Cadastro e Solicitação de Orçamento</h2>

    <form action="{{ route('diarista.orcamento') }}" method="POST">
        @csrf

        <div class="full"><h3>Seus dados</h3></div>

        <div>
            <label for="name">Nome completo *</label>
            <input id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div>
            <label for="email">E-mail *</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div>
            <label for="phone">Telefone / WhatsApp *</label>
            <input id="phone" name="phone" value="{{ old('phone') }}" required>
        </div>

        <div class="full">
            <label for="address">Endereço (bairro / região) *</label>
            <input id="address" name="address" value="{{ old('address') }}" required>
        </div>

        <div class="full"><h3>Detalhes do serviço</h3></div>

        <div>
            <label for="property_type">Tipo de imóvel *</label>
            <select id="property_type" name="property_type" required>
                <option value="">Selecione...</option>
                <option value="Casa"        @selected(old('property_type') === 'Casa')>Casa</option>
                <option value="Apartamento" @selected(old('property_type') === 'Apartamento')>Apartamento</option>
                <option value="Escritório"  @selected(old('property_type') === 'Escritório')>Escritório</option>
                <option value="Outro"       @selected(old('property_type') === 'Outro')>Outro</option>
            </select>
        </div>

        <div>
            <label for="rooms">Quantidade de quartos *</label>
            <input type="number" id="rooms" name="rooms" min="0" value="{{ old('rooms', 2) }}" required>
        </div>

        <div>
            <label for="bathrooms">Quantidade de banheiros *</label>
            <input type="number" id="bathrooms" name="bathrooms" min="0" value="{{ old('bathrooms', 1) }}" required>
        </div>

        <div>
            <label>Possui animais de estimação?</label>
            <div class="checkbox-group">
                <input type="checkbox" id="has_pets" name="has_pets" value="1" @checked(old('has_pets'))>
                <span>Sim, tenho pets</span>
            </div>
        </div>

        <div>
            <label for="service_date">Data desejada *</label>
            <input type="date" id="service_date" name="service_date" value="{{ old('service_date') }}" required>
        </div>

        <div>
            <label for="frequency">Frequência *</label>
            <select id="frequency" name="frequency" required>
                <option value="">Selecione...</option>
                <option value="Única"      @selected(old('frequency') === 'Única')>Serviço único</option>
                <option value="Semanal"    @selected(old('frequency') === 'Semanal')>Semanal</option>
                <option value="Quinzenal"  @selected(old('frequency') === 'Quinzenal')>Quinzenal</option>
                <option value="Mensal"     @selected(old('frequency') === 'Mensal')>Mensal</option>
            </select>
        </div>

        <div class="full">
            <label for="details">Observações</label>
            <textarea id="details" name="details"
                      placeholder="Ex: limpar dentro do forno, armários, prédio sem elevador, etc.">{{ old('details') }}</textarea>
        </div>

        <div class="full">
            <button type="submit">Solicitar orçamento</button>
        </div>
    </form>
</div>

<footer>
    &copy; {{ date('Y') }} Serviço de Diarista. Todos os direitos reservados.
</footer>
</body>
</html>
