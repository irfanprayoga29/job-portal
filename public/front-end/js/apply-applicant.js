function updateStatus(status, element) {
    const card = element.closest('.applicant-card');
    const statusBadge = card.querySelector('.status-badge');

    statusBadge.classList.remove('status-new', 'status-accepted', 'status-rejected');

    switch(status) {
        case 'accepted':
            statusBadge.classList.add('status-accepted');
            statusBadge.textContent = 'ACCEPTED';
            break;
        case 'rejected':
            statusBadge.classList.add('status-rejected');
            statusBadge.textContent = 'DECLINED';
            break;
        default:
            statusBadge.classList.add('status-new');
            statusBadge.textContent = 'NEW';
    }
}
