// to get current year
function getYear() {
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();
    document.querySelector("#displayYear").innerHTML = currentYear;
}

getYear();

// owl carousel

$('.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    autoplay: true,
    autoplayHoverPause: true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 3
        },
        1000: {
            items: 6
        }
    }
})

$(".delete").click(function(e){
    e.preventDefault();
    const form = $(this).parents("form");
    Swal.fire({
    title: "Are you sure?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
    }).then((result) => {
    if (result.isConfirmed) {
        form.submit();
    }
    });
})

const card = document.getElementById('payment2')
const cash = document.getElementById('payment1')
const div = document.getElementById('payment-card')

card.addEventListener('click', function(){
    div.style.display = 'block'
})

cash.addEventListener('click', function(){
    div.style.display = 'none'
})

