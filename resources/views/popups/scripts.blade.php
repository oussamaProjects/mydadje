<script type="text/javascript">
    const buttonFile = document.getElementById('buttonmodalFile')
    const closebuttonFile = document.getElementById('closebuttonFile')
    const modalFile = document.getElementById('modalFile')

    buttonFile.addEventListener('click', () => modalFile.classList.add('scale-100'))
    closebuttonFile.addEventListener('click', () => modalFile.classList.remove('scale-100'))

    const buttonDossier = document.getElementById('buttonmodalDossier')
    const closebuttonDossier = document.getElementById('closebuttonDossier')
    const modalDossier = document.getElementById('modalDossier')
    if (buttonDossier)
        buttonDossier.addEventListener('click', () => modalDossier.classList.add('scale-100'))
    closebuttonDossier.addEventListener('click', () => modalDossier.classList.remove('scale-100'))

    const closebuttonCategorie = document.getElementById('closebuttonCategorie')
    const modalCategorie = document.getElementById('modalCategorie')

    closebuttonCategorie.addEventListener('click', () => modalCategorie.classList.remove('scale-100'))

    const closebutton2 = document.getElementById('closebutton2')
    const modal2 = document.getElementById('modal2')

    closebutton2.addEventListener('click', () => modal2.classList.remove('scale-100'))

    const add_folder_main = document.getElementById('add_folder_main')
    add_folder_main.addEventListener('click', () => modalDossier.classList.add('scale-100'))

    const add_folder = document.getElementById('add_folder')
    add_folder.addEventListener('click', () => modal2.classList.add('scale-100'))

    const add_categorie = document.getElementById('add_categorie')
    add_categorie.addEventListener('click', () => modalCategorie.classList.add('scale-100'))

    function handleSelect(elm) {

        if (elm.value == 'add_folder_main') {
            modalDossier.classList.add('scale-100')
        }

        if (elm.value == 'add_folder') {
            modal2.classList.add('scale-100')
        }

        if (elm.value == 'add_categorie') {
            modalCategorie.classList.add('scale-100')
        }

    }

    function checkRadio(value) {
        console.log(value);
        if (value == 2) {
            document.getElementById("dossier_parent").classList.add("hidden");
        }
        if (value == 1) {
            document.getElementById("dossier_parent").classList.remove("hidden");
        }
    }
</script>
