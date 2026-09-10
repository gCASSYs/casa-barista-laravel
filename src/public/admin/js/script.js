document.addEventListener('DOMContentLoaded', () => {
  const inputBanner = document.getElementById('img-banner');
  const previewBanner = document.getElementById('ver-banner');
  const uploadTrigger = document.getElementById('banner-upload-trigger');

  if (!inputBanner || !previewBanner || !uploadTrigger) {
    return;
  }

  uploadTrigger.addEventListener('keydown', (event) => {
    if (event.key === 'Enter' || event.key === ' ') {
      event.preventDefault();
      inputBanner.click();
    }
  });

  inputBanner.addEventListener('change', () => {
    const [arquivo] = inputBanner.files;

    if (!arquivo) {
      return;
    }

    previewBanner.src = URL.createObjectURL(arquivo);
    previewBanner.alt = `Prévia de ${arquivo.name}`;
    uploadTrigger.classList.add('has-preview');
  });
});
