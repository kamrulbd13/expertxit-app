@extends('frontend.layout.master')
@section('mainContent')

@include('frontend.job_guarantee_course.components.JobGuaranteeProgram')
@include('frontend.job_guarantee_course.components.AboutJobGuaranteeProgram')
@include('frontend.job_guarantee_course.components.SuccessStories')
@include('frontend.job_guarantee_course.components.JobGuaranteeProgramWorks')
@include('frontend.job_guarantee_course.components.Faq')
@include('frontend.job_guarantee_course.components.LaunchYourNetworkingCareer')


<script>
    // Tab functionality
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const tabId = btn.getAttribute('data-tab');

            // Remove active class from all buttons and contents
            tabBtns.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));

            // Add active class to clicked button and corresponding content
            btn.classList.add('active');
            document.getElementById(tabId).classList.add('active');
        });
    });

    // Accordion functionality
    const accordionItems = document.querySelectorAll('.accordion-item');

    accordionItems.forEach(item => {
        const header = item.querySelector('.accordion-header');

        header.addEventListener('click', () => {
            // Close all other items
            accordionItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                }
            });

            // Toggle current item
            item.classList.toggle('active');
        });
    });
</script>


@endsection
