const statusInputs = Array.from(document.querySelectorAll(".statusInput"))
const meta = document.querySelector('meta[name="csrf-token"]')

statusInputs.forEach(statusInput => {
    statusInput.addEventListener('click', async function() {
        const formData = new FormData()
        formData.append('uuid', this.previousElementSibling.value)
    
        const url = this.parentElement.parentElement.getAttribute('action')
    
        const response = await fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': meta.getAttribute('content')
            }
        })
    
        if (!response.ok) {
            const errorBlock = document.querySelector('.nested_error_block')
            errorBlock.classList.replace('nested_error_block', 'alert alert-danger mt-1 alert-dismissible')
            errorBlock.innerHTML = `
                    <div class="alert-body d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-info me-50">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="16" x2="12" y2="12"></line>
                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                        </svg>
                        <span>Il y'a eu une erreur avec l'ajout du restaurant!</span>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `
        }
    })
    
})
