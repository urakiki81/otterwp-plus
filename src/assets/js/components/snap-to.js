const snapContainer = document.querySelector('.is-style-all-snap');
const snapWrapper = snapContainer.querySelector('.wc-block-grid__products');

snapContainer.addEventListener('scroll', () => {
  snapToNearestItem();
});

function snapToNearestItem() {
  const snapItems = snapWrapper.querySelectorAll('.wc-block-grid__product');
  const currentScrollPosition = snapContainer.scrollLeft;
  const snapPositions = Array.from(snapItems).map(item => item.offsetLeft);
  const closestSnapPosition = snapPositions.reduce((a, b) => {
    return Math.abs(b - currentScrollPosition) < Math.abs(a - currentScrollPosition) ? b : a;
  });

  snapWrapper.scrollTo({
    left: closestSnapPosition,
    behavior: 'smooth'
  });
}