function appendAlert (message, type, idElement){
  const wrapper = document.createElement('div');
  wrapper.innerHTML = [
    `<div class="alert alert-${converteStatus(type)} alert-dismissible" role="alert">`,
    `   <div>${message}</div>`,
    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
    '</div>'
  ].join('')

  console.log(wrapper);

  $(idElement).html(wrapper);
}

function converteStatus(status){
  if(status > 399){
    return 'danger';
  }
  return 'success';
}