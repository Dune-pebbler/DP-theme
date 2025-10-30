jQuery(document).ready(function () {
  startOwlSlider();
  setHamburgerActiveToggle();
  initMap();
  setParalaxScroll();
  setAnimations();
  setFaqOpen();
  initInView();
  initMasonry();
  initArchiveBlock();
  // initFancybox(); //this needs to be checked have not confirmed this works
});
jQuery(window).scroll(function () {});
jQuery(window).resize(function () {});

function setHamburgerActiveToggle() {
  jQuery(".hamburger").on("click", function () {
    jQuery(".cross").addClass("is-active");
    jQuery(".hamburger").removeClass("is-active");
    jQuery("#nav-menu").addClass("is-active");
    jQuery("body, html").addClass("scroll-block");
  });
  jQuery(".cross").on("click", function () {
    jQuery(".hamburger").addClass("is-active");
    jQuery(".cross").removeClass("is-active");
    jQuery("#nav-menu").removeClass("is-active");
    jQuery("body, html").removeClass("scroll-block");
  });
}

function setFaqOpen() {
  jQuery(".faq-question").on("click", function () {
    var item = jQuery(this).closest(".faq-item");
    jQuery(".faq-item").not(item).removeClass("active");
    item.toggleClass("active");
  });
}
function hideOnScroll() {
  //needs work
  var currentScrollTop = jQuery(window).scrollTop();
  if (togglePosition < currentScrollTop && togglePosition > 180 && !isMobile) {
    mainHeader.addClass("hide");
  } else {
    mainHeader.removeClass("hide");
  }
  togglePosition = currentScrollTop;
}

function startOwlSlider() {
  jQuery(".owl-1").owlCarousel({
    dots: false,
    nav: true,
    margin: 12,
    items: 1,
    loop: true,
  });
  jQuery(".owl-2").owlCarousel({
    dots: false,
    nav: true,
    margin: 12,
    loop: true,

    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 2,
      },
      1000: {
        items: 2,
      },
    },
  });
  jQuery(".owl-3").owlCarousel({
    loop: true,
    margin: 20,
    nav: false,
    dots: false,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    smartSpeed: 1500,
    animateIn: "fadeIn",
    animateOut: "fadeOut",
    center: true,
    responsive: {
      0: {
        items: 3,
      },
      600: {
        items: 4,
      },
      1000: {
        items: 5,
      },
    },
  });

  // Hero Slider Block initialization
  jQuery(".hero_slider_block__slider").each(function () {
    const slider = jQuery(this);
    const autoplay = slider.attr("data-autoplay") === "true";
    const autoplaySpeed = parseInt(slider.attr("data-autoplay-speed")) || 5000;

    slider.owlCarousel({
      items: 1,
      loop: true,
      autoplay: autoplay,
      autoplayTimeout: autoplaySpeed,
      autoplayHoverPause: true,
      nav: true,
      navText: [
        '<i class="fas fa-chevron-left"></i>',
        '<i class="fas fa-chevron-right"></i>',
      ],
      dots: true,
      animateOut: "fadeOut",
      animateIn: "fadeIn",
      smartSpeed: 1000,
      responsive: {
        0: {
          items: 1,
        },
        768: {
          items: 1,
        },
        1024: {
          items: 1,
        },
      },
    });
  });

  // Logo Slider Block initialization (base)
  jQuery(".logo_slider_block__slider").each(function () {
    const slider = jQuery(this);
    const speed = parseInt(slider.attr("data-speed")) || 8000;

    slider.owlCarousel({
      loop: true,
      margin: 30,
      nav: false,
      dots: false,
      autoplay: true,
      autoplayTimeout: speed,
      autoplaySpeed: speed,
      smartSpeed: speed,
      slideTransition: "linear",
      autoplayHoverPause: true,
      responsive: {
        0: { items: 3 },
        600: { items: 5 },
        1000: { items: 7 },
      },
    });
  });
}

async function initMap() {
  // Initialize all Google Maps on the page
  const mapElements = document.querySelectorAll('[id^="google-map-"], #map');

  if (mapElements.length === 0) {
    return;
  }

  // Request needed libraries.
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary(
    "marker"
  );

  // Initialize each map
  mapElements.forEach(async (mapElement) => {
    try {
      const lat = parseFloat(mapElement.getAttribute("data-lat"));
      const lng = parseFloat(mapElement.getAttribute("data-lng"));
      const address = mapElement.getAttribute("data-address");
      const zoom = parseInt(mapElement.getAttribute("data-zoom")) || 15;

      if (!lat || !lng) {
        console.warn(
          "Google Maps: Missing coordinates for map element",
          mapElement
        );
        mapElement.classList.add("google_maps_block__map--error");
        return;
      }

      // Add loading state
      mapElement.classList.add("google_maps_block__map--loading");

      const map = new Map(mapElement, {
        center: { lat, lng },
        zoom: zoom,
        mapId: "4504f8b37365c3d0",
        mapTypeControl: true,
        streetViewControl: true,
        fullscreenControl: true,
        zoomControl: true,
      });

      // Create marker
      let markerContent;

      // Check if there's a logo marker for the main map
      if (mapElement.id === "map" && document.getElementById("logo-marker")) {
        const logoMarkerUrl = document.createElement("img");
        if (document.getElementById("logo-marker").src) {
          logoMarkerUrl.src = document.getElementById("logo-marker").src;
          markerContent = logoMarkerUrl;
        }
      }

      // If no custom marker, create a default pin
      if (!markerContent) {
        const pinElement = new PinElement({
          background: "#4285F4",
          borderColor: "#137333",
          glyphColor: "#ffffff",
        });
        markerContent = pinElement.element;
      }

      const marker = new AdvancedMarkerElement({
        map,
        position: { lat, lng },
        content: markerContent,
        title: address || "Locatie",
      });

      // Remove loading state
      mapElement.classList.remove("google_maps_block__map--loading");
    } catch (error) {
      console.error("Google Maps initialization error:", error);
      mapElement.classList.remove("google_maps_block__map--loading");
      mapElement.classList.add("google_maps_block__map--error");
    }
  });
}

function setParalaxScroll() {
  var scrollTop = jQuery(window).scrollTop();
  var slowScrollRate = 0.4;

  jQuery(".slow-scroll").each(function () {
    var offset = scrollTop * slowScrollRate;
    jQuery(this).css("transform", "translateY(" + offset + "px)");
  });
}

function setAnimations() {
  const animateElements = document.querySelectorAll(
    "[data-animate^='fade'], [data-animate^='zoom']"
  );

  inView("[data-animate^='fade']").on("enter", (el) => {
    el.classList.add("animate");
  });
  inView("[data-animate^='zoom']").on("enter", (el) => {
    el.classList.add("animate");
  });

  animateElements.forEach((el) => {
    if (inView.is(el)) {
      el.classList.add("animate");
    }
  });
}

function initFancybox() {
  Fancybox.bind("[data-fancybox]", {
    // Your options here
  });
  Ï;

  Fancybox.bind("[data-fancybox]", {
    on: {
      closing: (fancybox, slide) => {
        setTimeout(() => {
          masonryInstance.layout();
        }, 250);
      },
    },
  });
}
// Initialize inView functionality
function initInView() {
  // Check if inView is available (library loaded)
  if (typeof inView !== "undefined") {
    // Helper to set enter/exit behavior
    function setInView(selector) {
      inView(selector)
        .on("enter", function (el) {
          el.classList.add("in-view");
        })
        .on("exit", function (el) {
          el.classList.remove("in-view"); // Reset when leaving view
        });
    }

    // Apply to all your animations
    setInView(".fade-in-on-scroll");
    setInView(".slide-left-on-scroll");
    setInView(".slide-right-on-scroll");
    setInView(".scale-up-on-scroll");
    setInView(".rotate-in-on-scroll");
    setInView(".bounce-in-on-scroll");
    setInView(".flip-in-on-scroll");
    setInView(".typewriter-on-scroll");
    setInView(".delayed-on-scroll");

    // For staggered items
    inView(".stagger-on-scroll")
      .on("enter", function (el) {
        var children = el.querySelectorAll(".stagger-item");
        children.forEach(function (child, index) {
          setTimeout(function () {
            child.classList.add("in-view");
          }, index * 100);
        });
      })
      .on("exit", function (el) {
        // Reset staggered items
        var children = el.querySelectorAll(".stagger-item");
        children.forEach(function (child) {
          child.classList.remove("in-view");
        });
      });

    console.log("All inView listeners set up successfully");
  } else {
    console.error("inView library not loaded");
    fallbackScrollAnimation();
  }
}
function initMasonry() {
  var grid = document.querySelector(".masonry-grid");
  if (grid) {
    var msnry = new Masonry(grid, {
      itemSelector: ".masonry-item",
      columnWidth: ".masonry-item",
      percentPosition: true,
      gutter: 20,
      fitWidth: true,
    });

    // Layout after images load (without imagesLoaded library)
    var images = grid.querySelectorAll("img");
    var loadedImages = 0;
    var totalImages = images.length;

    if (totalImages === 0) {
      // No images, layout immediately
      msnry.layout();
    } else {
      // Wait for all images to load
      images.forEach(function (img) {
        if (img.complete) {
          loadedImages++;
        } else {
          img.addEventListener("load", function () {
            loadedImages++;
            if (loadedImages === totalImages) {
              msnry.layout();
            }
          });
        }
      });

      // If all images were already loaded
      if (loadedImages === totalImages) {
        msnry.layout();
      }
    }

    window.addEventListener("resize", function () {
      msnry.layout();
    });
  }
}

// Archive Block functionality
function initArchiveBlock() {
  jQuery(".archive_block").each(function () {
    const archiveBlock = jQuery(this);
    const postType = archiveBlock.attr("data-post-type");
    const postsPerPage =
      parseInt(archiveBlock.attr("data-posts-per-page")) || 3;
    const searchInput = archiveBlock.find("[data-search-input]");
    const searchButton = archiveBlock.find("[data-search-button]");
    const postsGrid = archiveBlock.find("[data-posts-grid]");
    const loading = archiveBlock.find("[data-loading]");
    const loadMoreBtn = archiveBlock.find("[data-load-more]");
    const paginationInfo = archiveBlock.find("[data-pagination-info]");

    let currentPage = 1;
    let isLoading = false;
    let currentSearchTerm = "";
    let hasMorePosts = true;

    // Search functionality
    function performSearch(searchTerm = "") {
      if (isLoading) return;

      currentSearchTerm = searchTerm;
      currentPage = 1;
      hasMorePosts = true;

      showLoading();

      jQuery.ajax({
        url: ajax_object.ajax_url,
        type: "POST",
        data: {
          action: "archive_block_search",
          post_type: postType,
          posts_per_page: postsPerPage,
          page: currentPage,
          search: searchTerm,
          nonce: ajax_object.nonce,
        },
        success: function (response) {
          hideLoading();
          if (response.success) {
            postsGrid.html(response.data.html);
            updatePaginationInfo(
              response.data.current_count,
              response.data.total_count
            );
            hasMorePosts = response.data.has_more;
            currentPage = 1;

            if (loadMoreBtn.length && !hasMorePosts) {
              loadMoreBtn.hide();
            } else if (loadMoreBtn.length && hasMorePosts) {
              loadMoreBtn.show();
            }
          } else {
            postsGrid.html(
              '<div class="archive_block__no-posts"><p>No posts found.</p></div>'
            );
            updatePaginationInfo(0, 0);
          }
        },
        error: function (xhr, status, error) {
          hideLoading();
          postsGrid.html(
            '<div class="archive_block__no-posts"><p>Error loading posts. Please try again.</p></div>'
          );
        },
      });
    }

    // Load more posts
    function loadMorePosts() {
      if (isLoading || !hasMorePosts) return;

      isLoading = true;
      currentPage++;
      showLoading();

      jQuery.ajax({
        url: ajax_object.ajax_url,
        type: "POST",
        data: {
          action: "archive_block_load_more",
          post_type: postType,
          posts_per_page: postsPerPage,
          page: currentPage,
          search: currentSearchTerm,
          nonce: ajax_object.nonce,
        },
        success: function (response) {
          hideLoading();
          isLoading = false;

          if (response.success) {
            postsGrid.append(response.data.html);
            updatePaginationInfo(
              response.data.current_count,
              response.data.total_count
            );
            hasMorePosts = response.data.has_more;

            if (!hasMorePosts && loadMoreBtn.length) {
              loadMoreBtn.hide();
            }
          }
        },
        error: function () {
          hideLoading();
          isLoading = false;
        },
      });
    }

    // Show loading state
    function showLoading() {
      loading.show();
    }

    // Hide loading state
    function hideLoading() {
      loading.hide();
    }

    // Update pagination info
    function updatePaginationInfo(current, total) {
      paginationInfo.find("[data-current-count]").text(current);
      paginationInfo.find("[data-total-count]").text(total);
      paginationInfo.show();
    }

    // Infinite scroll
    function initInfiniteScroll() {
      if (loadMoreBtn.length) return; // Don't use infinite scroll if load more button is present

      jQuery(window).on("scroll", function () {
        if (isLoading || !hasMorePosts) return;

        const scrollTop = jQuery(window).scrollTop();
        const windowHeight = jQuery(window).height();
        const documentHeight = jQuery(document).height();

        if (scrollTop + windowHeight >= documentHeight - 100) {
          loadMorePosts();
        }
      });
    }

    // Event listeners
    if (searchInput.length) {
      // Search on input (with debounce)
      let searchTimeout;
      searchInput.on("input", function () {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function () {
          performSearch(jQuery(this).val());
        }, 500);
      });

      // Search on button click
      if (searchButton.length) {
        searchButton.on("click", function () {
          performSearch(searchInput.val());
        });
      }

      // Search on Enter key
      searchInput.on("keypress", function (e) {
        if (e.which === 13) {
          performSearch(jQuery(this).val());
        }
      });
    }

    // Load more button
    if (loadMoreBtn.length) {
      loadMoreBtn.on("click", function () {
        loadMorePosts();
      });
    }

    // Initialize infinite scroll if no load more button
    if (!loadMoreBtn.length) {
      initInfiniteScroll();
    }
  });
}
