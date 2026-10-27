<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro - Soñando y Creciendo en Grande 2027</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-black text-gray-800 antialiased font-sans flex flex-col items-center justify-center min-h-screen py-10 px-4">
    
    <div class="max-w-3xl w-full bg-white rounded-2xl shadow-2xl overflow-hidden border-t-4 border-red-600">
        
        <!-- Encabezado con Tema Político -->
        <div class="bg-red-600 p-8 text-center relative">
            <a href="{{ route('login') }}" class="text-2xl md:text-3xl font-black text-white uppercase tracking-wider block hover:text-gray-200 transition-colors">
                SOÑANDO Y CRECIENDO EN GRANDE
            </a>
            <p class="text-white mt-2 font-bold text-xl">2027 Más Triunfos</p>
            <p class="text-sm text-gray-100 mt-2 font-medium">Conversatorio de Líneas Generales</p>
            <div class="mt-5">
                <span class="text-xs text-white bg-black inline-block px-5 py-2 rounded-full font-bold shadow-inner">
                    Centro Tecnológico Olof Palme
                </span>
            </div>
        </div>

        <!-- Formulario -->
        <div class="p-8 md:p-10">
            <h2 class="text-center text-2xl font-bold text-black mb-8 uppercase tracking-wide">Registro de Participación</h2>
            
            <form action="{{ route('participants.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label for="nombre_completo" class="block text-sm font-bold text-gray-600 uppercase mb-1">Nombre Completo</label>
                    <input type="text" name="nombre_completo" id="nombre_completo" value="{{ old('nombre_completo') }}" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-red-600 focus:ring focus:ring-red-600 focus:ring-opacity-50 py-3 px-4 border text-gray-700 font-medium">
                </div>

                <div>
                    <label for="tipo_procedencia" class="block text-sm font-bold text-gray-600 uppercase mb-1">Tipo de Procedencia</label>
                    <select name="tipo_procedencia" id="tipo_procedencia" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-red-600 focus:ring focus:ring-red-600 focus:ring-opacity-50 py-3 px-4 border text-gray-700 font-medium">
                        <option value="" disabled selected>Seleccione...</option>
                        <option value="INATEC" @if(old('tipo_procedencia') == 'INATEC') selected @endif>INATEC</option>
                        <option value="MINED" @if(old('tipo_procedencia') == 'MINED') selected @endif>MINED</option>
                        <option value="SETEC / Universidades" @if(old('tipo_procedencia') == 'SETEC / Universidades') selected @endif>SETEC / Universidades</option>
                        <option value="Otras Instituciones" @if(old('tipo_procedencia') == 'Otras Instituciones') selected @endif>Otras Instituciones</option>
                        <option value="Público General" @if(old('tipo_procedencia') == 'Público General') selected @endif>Público General</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div id="wrapper_departamento">
                        <label id="label_departamento" for="departamento" class="block text-sm font-bold text-gray-600 uppercase mb-1">Departamento</label>
                        <div id="container_input_departamento"></div>
                    </div>
                    <div id="wrapper_centro">
                        <label id="label_centro" for="centro_procedencia" class="block text-sm font-bold text-gray-600 uppercase mb-1">Centro de Procedencia</label>
                        <div id="container_input_centro"></div>
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full flex justify-center py-4 px-4 border border-transparent rounded-lg shadow-lg text-lg font-black text-white bg-red-600 hover:bg-black focus:outline-none focus:ring-4 focus:ring-red-600 focus:ring-opacity-50 transition-all transform hover:-translate-y-1">
                        REGISTRAR PARTICIPACIÓN
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Alertas con SweetAlert2 adaptadas al tema -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success'))
                Swal.fire({ 
                    icon: 'success', 
                    title: '¡Registro Exitoso!', 
                    text: '{{ session("success") }}', 
                    confirmButtonColor: '#000000',
                    customClass: { popup: 'rounded-2xl' }
                });
            @endif

            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Verifique los datos',
                    html: '<ul class="text-left font-medium text-gray-700">@foreach($errors->all() as $error)<li>⚠️ {{ $error }}</li>@endforeach</ul>',
                    confirmButtonColor: '#dc2626',
                    customClass: { popup: 'rounded-2xl' }
                });
            @endif
        });
    </script>

    <script>
        const dataINATEC = {
            "Managua": ["Centro Tecnológico Simón Bolívar (y sub sede Muchachos, Horizonte Valiente)", "Centro Tecnológico de Idiomas “Héroes y Mártires de Batahola”", "Centro Tecnológico de Hotelería y Turismo “Amanda Aguilar”", "Centro Tecnológico Manuel Olivares Rodríguez (y sub sede Ariel Darce)", "Centro Tecnológico Padre Rafael María Fabretto", "Centro Tecnológico Acahualinca", "Centro Tecnológico Comandante Hugo Chávez Frías", "Centro Tecnológico Cultural y Politécnico José Coronel Urtecho", "Centro Nacional de Desarrollo del Talento Creativo Nieves Cajina", "Escuela Hotel Casa Luxemburgo (Pochomil)"],
            "Granada": ["Centro Tecnológico General Miguel Ángel Ortez", "Centro Tecnológico Bidkar Muñoz", "Centro Tecnológico Pedro Aráuz Palacios", "Centro Tecnológico Gral. José Dolores Estrada (Nandaime)"],
            "Rivas": ["Centro Tecnológico Gaspar García Laviana", "Escuela Hotel Volcán Maderas (Isla de Ometepe)", "Centro Tecnológico Álvaro Diroy Méndez (Ometepe)"],
            "León": ["Centro Tecnológico Leonel Rugama", "Centro Tecnológico Juan de Dios Muñoz Reyes", "Centro Tecnológico Arlen Siu (El Sauce)"],
            "Masaya": ["Centro Tecnológico Martha Isabel Navarro Mendoza", "Centro Tecnológico Comandante Camilo Ortega Saavedra", "Centro Tecnológico Monimbó Heroico"],
            "Estelí": ["Centro Tecnológico Francisco Rivera Quintero “El Zorro”", "Centro Tecnológico Olof Palme"],
            "Matagalpa": ["Centro Tecnológico Monseñor Benedicto Herrera", "Centro Tecnológico Santiago Baldovino (Muy Muy)", "Centro Tecnológico Comandante Tomás Borge Martínez (San Isidro)"],
            "Jinotega": ["Centro Tecnológico Marcos Homero Guatemala", "Centro Tecnológico Héroes y Mártires de Asturias"],
            "Chinandega": ["Centro Tecnológico Padre Teodoro Kint (El Viejo)", "Centro Tecnológico Héroes y Mártires de Villa Nueva", "Centro Tecnológico Rolando Rodríguez González (Chichigalpa)"],
            "Madriz": ["Centro Tecnológico Coronel Santos López (Somoto)", "Centro Tecnológico Che Guevara (Somoto y sub sede Palacagüina)", "Centro Tecnológico José Eulogio Hernández Alvarado (Las Sabanas)", "Centro Tecnológico Padre Rafael María Fabretto (San José de Cusmapa)"],
            "Nueva Segovia": ["Centro Tecnológico Coronel Antonio Rufo Marín (Ocotal)"],
            "Chontales": ["Centro Tecnológico Josefa Toledo de Aguerri (Juigalpa)", "Centro Tecnológico Comandante Germán Pomares Ordóñez (Juigalpa)"],
            "Boaco": ["Centro Tecnológico Alcides Miranda Fitoria"],
            "Carazo": ["Centro Tecnológico Ricardo Morales Avilés (Diriamba)", "Centro Tecnológico Ernst Thalmann (Jinotepe)"],
            "Río San Juan": ["Centro Tecnológico Juan María Brenes Roque (San Carlos)"],
            "RAAN (Caribe Norte)": ["Centro Tecnológico Héroes y Mártires de Puerto Cabezas", "Centro Tecnológico Onofre Martínez (Waspán)"],
            "RAAS (Caribe Sur)": ["Centro Tecnológico William Schwartz Cunningham (Bluefields)", "Centro Tecnológico Hugo Francisco Urbina Rodríguez (El Rama)", "Centro Tecnológico Gral. Augusto Nicolás Calderón Sandino (Nueva Guinea)"],
            "Siuna": ["Centro Tecnológico Bernardino Díaz Ochoa"]
        };

        const dataSETEC = {
            "Managua": ["UNAN-Managua (RURD)", "UNAN-Managua (RUCFA)", "UNI (RUSB)", "UNI (RUPAP)", "UNA (Sede Central)", "UNHSJM (Sede Central)", "UNMRMA", "UNCPGGL", "UAM", "UCC", "UCN", "UAC", "UNICIT", "UNICA", "UdeM", "UTM", "UML", "UCYT", "UCEM", "UNITEC", "UNIVALLE", "UNIDES", "UNACAD", "UTC", "UMO-JN", "UCM", "ULAM", "UNIJJAR", "LAU", "American College"],
            "León": ["UNAN-León (Recinto Central)", "UNCPGGL (CUR-León)", "ULSA", "UCC"],
            "Estelí": ["UNAN-Managua (CUR-Estelí)", "UNI (Sede Regional UNI-Norte)", "UNHSJM (CUR-Estelí)", "UNFLEP", "UNCPGGL (CUR-Estelí)", "UNMRMA", "UCN", "UML"],
            "Chontales": ["UNAN-Managua (CUR-Chontales)", "UNI (Sede UNI-Juigalpa)", "UNA (Sede Universitaria Juigalpa)", "UNMRMA (CUR-Chontales)", "UNCPGGL (CUR-Juigalpa)"],
            "Boaco": ["UNA (Sede Universitaria Camoapa)", "UNHSJM (CUR-Boaco)"],
            "Carazo": ["UNAN-Managua (CUR-Carazo)", "UNMRMA (CUR-Carazo)", "UCN", "Keiser University"],
            "Rivas": ["UNIAV", "UNHSJM (CUR-Rivas)", "UNMRMA (CUR-Rivas)", "Universidad Anunciata"],
            "Chinandega": ["UNAN-León", "UNCPGGL (CUR-Chinandega)", "UNMRMA", "UACH", "UML"],
            "Matagalpa": ["UNAN-Managua (CUR-Matagalpa)", "UNCPGGL (CUR-Matagalpa)", "UNMRMA", "UCC"],
            "Nueva Segovia": ["UNCPGGL (CUR-Ocotal)", "UNAN-Managua (UNICAM)"],
            "Madriz": ["UNAN-León (CUR-Somoto)", "UNCPGGL", "UNAN-Managua (UNICAM)"],
            "Jinotega": ["UNAN-León (CUR-Jinotega)", "UNAN-Managua (UNICAM)", "UNMRMA"],
            "Granada": ["UNCPGGL (CUR-Granada)", "UNMRMA (CUR-Granada)"],
            "Masaya": ["UNCPGGL (CUR-Masaya)", "UNMRMA (CUR-Masaya)"],
            "Río San Juan": ["UNAN-León (Sede San Carlos)", "UNMRMA (CUR-Río San Juan)", "UNAN-Managua (UNICAM)"],
            "RACCN": ["URACCAN (Recinto Bilwi)", "URACCAN (Recinto Las Minas)", "BICU (Recinto Bilwi)"],
            "RACCS": ["BICU (Recinto Bluefields)", "BICU (CUR-El Rama)", "BICU (Laguna de Perlas)", "BICU (Corn Island)", "URACCAN"]
        };

        const tipoProcedencia = document.getElementById('tipo_procedencia');
        const labelCentro = document.getElementById('label_centro');
        const labelDepto = document.getElementById('label_departamento');
        
        const containerDepto = document.getElementById('container_input_departamento');
        const containerCentro = document.getElementById('container_input_centro');

        const oldDepto = "{{ old('departamento') }}";
        const oldCentro = "{{ old('centro_procedencia') }}";

        const defaultClass = "block w-full rounded-lg border-gray-300 shadow-sm focus:border-red-600 focus:ring focus:ring-red-600 focus:ring-opacity-50 py-3 px-4 border text-gray-700 font-medium";

        function buildInput(name, id, value, placeholder) {
            return `<input type="text" name="${name}" id="${id}" value="${value}" placeholder="${placeholder}" class="${defaultClass}" required>`;
        }

        function buildSelect(name, id, options, selectedValue) {
            let html = `<select name="${name}" id="${id}" class="${defaultClass}" required><option value="" disabled ${!selectedValue ? 'selected' : ''}>Seleccione...</option>`;
            options.forEach(opt => {
                html += `<option value="${opt}" ${selectedValue === opt ? 'selected' : ''}>${opt}</option>`;
            });
            html += `</select>`;
            return html;
        }

        function updateFormFields() {
            const tipo = tipoProcedencia.value;

            if (tipo === 'INATEC' || tipo === 'SETEC / Universidades') {
                const dataSource = tipo === 'INATEC' ? dataINATEC : dataSETEC;
                labelCentro.textContent = tipo === 'INATEC' ? 'CENTRO TECNOLÓGICO' : 'UNIVERSIDAD';
                labelDepto.textContent = 'DEPARTAMENTO';

                const deptos = Object.keys(dataSource);
                containerDepto.innerHTML = buildSelect('departamento', 'departamento', deptos, oldDepto);
                
                const deptoSelect = document.getElementById('departamento');
                
                const updateCentroSelect = () => {
                    const currentDepto = deptoSelect.value;
                    const centros = dataSource[currentDepto] || [];
                    containerCentro.innerHTML = buildSelect('centro_procedencia', 'centro_procedencia', centros, oldCentro);
                };

                deptoSelect.addEventListener('change', updateCentroSelect);
                if (oldDepto) updateCentroSelect();
                else containerCentro.innerHTML = buildSelect('centro_procedencia', 'centro_procedencia', [], '');

            } else if (tipo === 'MINED') {
                labelDepto.textContent = 'DEPARTAMENTO';
                labelCentro.textContent = 'COLEGIO / INSTITUTO';
                containerDepto.innerHTML = buildInput('departamento', 'departamento', oldDepto, '');
                containerCentro.innerHTML = buildInput('centro_procedencia', 'centro_procedencia', oldCentro, '');
            } else {
                labelDepto.textContent = 'DEPARTAMENTO';
                labelCentro.textContent = 'CENTRO / INSTITUCIÓN';
                containerDepto.innerHTML = buildInput('departamento', 'departamento', oldDepto, '');
                containerCentro.innerHTML = buildInput('centro_procedencia', 'centro_procedencia', oldCentro, '');
            }
        }

        tipoProcedencia.addEventListener('change', updateFormFields);
        
        if(tipoProcedencia.value) {
            updateFormFields();
        } else {
            containerDepto.innerHTML = buildInput('departamento', 'departamento', '', '');
            containerCentro.innerHTML = buildInput('centro_procedencia', 'centro_procedencia', '', '');
        }
    </script>
</body>
</html>