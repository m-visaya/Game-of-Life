<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="./static/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
      rel="stylesheet"
    />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="./static/script.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>

  <body>
    <div class="navbar" id="navbar">
      <button class="hamburger" onclick="openSidebar();">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          fill="currentColor"
          class="bi bi-list"
          viewBox="0 0 16 16"
        >
          <path
            fill-rule="evenodd"
            d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"
          />
        </svg>
      </button>
      <h2 class="appName1" id="appname1">game o</h2>
      <h2 class="appName2" id="appname2">f life</h2>
    </div>
    <div class="content-container">
      <div class="sidebar" id="sidebar">
      <button class="hamburger" onclick="openSidebar();">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          fill="currentColor"
          class="bi bi-list"
          viewBox="0 0 16 16"
          id="hamburger"
        >
          <path
            fill-rule="evenodd"
            d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"
          />
        </svg>
        </button>
        <div class="sidebar-top">
          <svg
            width="85%"
            viewBox="0 0 250 180"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
            id="applogo"
          >
            <path
              d="M3.63991 60.6303C3.63991 53.1729 5.38589 47.2248 8.87784 42.7859C12.3994 38.3174 17.0603 36.0831 22.8604 36.0831C28.3351 36.0831 32.6409 37.9918 35.7777 41.8093L36.266 36.9709H45.9872V83.5352C45.9872 89.8384 44.0193 94.81 40.0835 98.4499C36.1772 102.09 30.8949 103.91 24.2365 103.91C20.715 103.91 17.2674 103.17 13.8938 101.69C10.5498 100.24 8.00485 98.3316 6.25888 95.9641L11.3636 89.4833C14.678 93.4192 18.7618 95.3871 23.6151 95.3871C27.1958 95.3871 30.0219 94.4105 32.0934 92.4574C34.1649 90.5339 35.2006 87.6929 35.2006 83.9347V80.6942C32.0934 84.1566 27.9504 85.8878 22.7717 85.8878C17.149 85.8878 12.5473 83.6535 8.96662 79.185C5.41548 74.7165 3.63991 68.5316 3.63991 60.6303ZM14.3821 61.5625C14.3821 66.3861 15.3587 70.1888 17.3118 72.9705C19.2945 75.7227 22.0318 77.0987 25.5238 77.0987C29.8739 77.0987 33.0996 75.2344 35.2006 71.5057V50.3764C33.1587 46.7365 29.9627 44.9165 25.6126 44.9165C22.0614 44.9165 19.2945 46.3222 17.3118 49.1335C15.3587 51.9448 14.3821 56.0878 14.3821 61.5625ZM85.8043 85C85.3309 84.0826 84.9166 82.5882 84.5614 80.5167C81.1287 84.0974 76.9265 85.8878 71.9549 85.8878C67.1313 85.8878 63.1954 84.5117 60.1474 81.7596C57.0993 79.0075 55.5753 75.6043 55.5753 71.5501C55.5753 66.4305 57.4692 62.5095 61.2571 59.7869C65.0746 57.0348 70.5197 55.6587 77.5923 55.6587H84.2063V52.5071C84.2063 50.0213 83.5109 48.0386 82.12 46.5589C80.7292 45.0497 78.6133 44.2951 75.7724 44.2951C73.3162 44.2951 71.3039 44.9165 69.7354 46.1594C68.167 47.3727 67.3828 48.9264 67.3828 50.8203H56.5962C56.5962 48.1866 57.4692 45.7303 59.2152 43.4517C60.9612 41.1435 63.3286 39.3383 66.3175 38.0362C69.3359 36.7341 72.6947 36.0831 76.3938 36.0831C82.0165 36.0831 86.4998 37.5035 89.8438 40.3445C93.1877 43.1558 94.9041 47.1212 94.9929 52.2408V73.9027C94.9929 78.2232 95.5996 81.6708 96.8129 84.2454V85H85.8043ZM73.9524 77.2319C76.0831 77.2319 78.0806 76.714 79.945 75.6783C81.8389 74.6425 83.2594 73.2517 84.2063 71.5057V62.4503H78.3913C74.3963 62.4503 71.3926 63.1457 69.3803 64.5366C67.368 65.9274 66.3619 67.8954 66.3619 70.4403C66.3619 72.5118 67.0425 74.169 68.4038 75.4119C69.7946 76.6252 71.6442 77.2319 73.9524 77.2319ZM116.433 36.9709L116.744 41.9869C120.117 38.051 124.734 36.0831 130.593 36.0831C137.015 36.0831 141.409 38.5393 143.777 43.4517C147.269 38.5393 152.181 36.0831 158.514 36.0831C163.811 36.0831 167.747 37.5479 170.321 40.4776C172.926 43.4073 174.257 47.7279 174.316 53.4393V85H163.53V53.75C163.53 50.7019 162.864 48.4677 161.532 47.0472C160.201 45.6268 157.996 44.9165 154.918 44.9165C152.462 44.9165 150.45 45.5824 148.881 46.9141C147.343 48.2161 146.262 49.9325 145.641 52.0632L145.685 85H134.899V53.3949C134.751 47.7427 131.866 44.9165 126.243 44.9165C121.922 44.9165 118.86 46.6773 117.054 50.1989V85H106.268V36.9709H116.433ZM206.543 85.8878C199.707 85.8878 194.158 83.7423 189.897 79.4513C185.665 75.1308 183.549 69.3898 183.549 62.2283V60.8967C183.549 56.1026 184.467 51.8265 186.302 48.0682C188.166 44.2803 190.77 41.3358 194.114 39.2347C197.458 37.1336 201.187 36.0831 205.3 36.0831C211.84 36.0831 216.886 38.1694 220.437 42.342C224.018 46.5146 225.808 52.4183 225.808 60.0533V64.4034H194.425C194.75 68.3688 196.067 71.5057 198.375 73.8139C200.713 76.1222 203.643 77.2763 207.164 77.2763C212.106 77.2763 216.131 75.2788 219.238 71.2837L225.053 76.8324C223.13 79.7029 220.555 81.9371 217.33 83.5352C214.134 85.1036 210.538 85.8878 206.543 85.8878ZM205.256 44.739C202.296 44.739 199.899 45.7747 198.065 47.8462C196.259 49.9177 195.105 52.803 194.602 56.5021H215.154V55.7031C214.918 52.0928 213.956 49.3703 212.269 47.5355C210.582 45.6712 208.245 44.739 205.256 44.739Z"
              fill="white"
            />
            <path
              d="M123.062 168.333H112.275V100.152H123.062V168.333ZM146.322 168.333H135.535V120.304H146.322V168.333ZM134.869 107.831C134.869 106.174 135.387 104.798 136.423 103.703C137.488 102.608 138.997 102.06 140.951 102.06C142.904 102.06 144.413 102.608 145.478 103.703C146.544 104.798 147.076 106.174 147.076 107.831C147.076 109.458 146.544 110.82 145.478 111.915C144.413 112.98 142.904 113.513 140.951 113.513C138.997 113.513 137.488 112.98 136.423 111.915C135.387 110.82 134.869 109.458 134.869 107.831ZM161.902 168.333V128.294H154.578V120.304H161.902V115.91C161.902 110.583 163.382 106.47 166.341 103.57C169.3 100.669 173.443 99.2194 178.77 99.2194C180.664 99.2194 182.676 99.4857 184.807 100.018L184.541 108.452C183.357 108.216 181.981 108.097 180.413 108.097C175.263 108.097 172.689 110.746 172.689 116.043V120.304H182.454V128.294H172.689V168.333H161.902ZM210.42 169.221C203.584 169.221 198.035 167.076 193.774 162.785C189.542 158.464 187.426 152.723 187.426 145.562V144.23C187.426 139.436 188.343 135.16 190.178 131.402C192.043 127.614 194.647 124.669 197.991 122.568C201.335 120.467 205.063 119.416 209.177 119.416C215.717 119.416 220.762 121.503 224.313 125.675C227.894 129.848 229.685 135.752 229.685 143.387V147.737H198.301C198.627 151.702 199.944 154.839 202.252 157.147C204.59 159.456 207.52 160.61 211.041 160.61C215.983 160.61 220.008 158.612 223.115 154.617L228.93 160.166C227.006 163.036 224.432 165.271 221.206 166.869C218.01 168.437 214.415 169.221 210.42 169.221ZM209.132 128.072C206.173 128.072 203.776 129.108 201.941 131.18C200.136 133.251 198.982 136.136 198.479 139.836H219.031V139.036C218.794 135.426 217.833 132.704 216.146 130.869C214.459 129.005 212.121 128.072 209.132 128.072Z"
              fill="#FF5F24"
            />
            <rect
              x="30.303"
              y="106.061"
              width="58.0808"
              height="58.0808"
              rx="29.0404"
              fill="#FF5F24"
            />
            <path
              d="M44.2112 138.221C44.2112 136.501 44.552 134.954 45.2335 133.58C45.915 132.196 46.8723 131.135 48.1055 130.4C49.3387 129.653 50.7558 129.28 52.3568 129.28C54.7259 129.28 56.646 130.043 58.1172 131.568C59.5992 133.093 60.3997 135.116 60.5187 137.637L60.5349 138.562C60.5349 140.292 60.1995 141.839 59.5289 143.202C58.869 144.565 57.917 145.62 56.673 146.367C55.4398 147.113 54.0119 147.486 52.3893 147.486C49.9121 147.486 47.927 146.664 46.4342 145.02C44.9522 143.365 44.2112 141.163 44.2112 138.416V138.221ZM48.1542 138.562C48.1542 140.368 48.5274 141.785 49.2738 142.813C50.0202 143.83 51.0587 144.338 52.3893 144.338C53.7198 144.338 54.7529 143.819 55.4885 142.781C56.2349 141.742 56.6081 140.222 56.6081 138.221C56.6081 136.447 56.2241 135.041 55.4561 134.002C54.6988 132.964 53.6657 132.444 52.3568 132.444C51.0695 132.444 50.0473 132.958 49.29 133.986C48.5328 135.003 48.1542 136.528 48.1542 138.562ZM65.2568 147.162V132.525H62.5794V129.605H65.2568V127.998C65.2568 126.051 65.7976 124.548 66.8794 123.487C67.9611 122.427 69.4756 121.897 71.4228 121.897C72.1151 121.897 72.8507 121.995 73.6295 122.189L73.5322 125.272C73.0995 125.186 72.5965 125.142 72.0231 125.142C70.1409 125.142 69.1998 126.111 69.1998 128.047V129.605H72.7695V132.525H69.1998V147.162H65.2568Z"
              fill="white"
            />
          </svg>
        </div>

        <div class="sidebar-center">
          <div class="container-date">
            <h3 id="date-today">Friday, October 8</h3>
            <hr />
          </div>
          <div class="today-pending">
            <h1 id="today-pending"></h1>
            <p>pending</p>
          </div>
          <div class="today-done">
            <h1 id="today-done"></h1>
            <p>done</p>
          </div>
        </div>
        <div class="user-details">
          <div class="user-stats">
            <div class="user-stat">
              <svg
                width="18"
                height="18"
                viewBox="0 0 86 86"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <g clip-path="url(#clip0)">
                  <path
                    d="M34.9375 5.375C32.7992 5.375 30.7485 6.22444 29.2365 7.73645C27.7244 9.24846 26.875 11.2992 26.875 13.4375V16.125H8.0625C5.92419 16.125 3.87346 16.9744 2.36145 18.4865C0.849439 19.9985 0 22.0492 0 24.1875L0 31.6265L40.9252 42.5378C42.2847 42.8998 43.7153 42.8998 45.0747 42.5378L86 31.6265V24.1875C86 22.0492 85.1506 19.9985 83.6385 18.4865C82.1265 16.9744 80.0758 16.125 77.9375 16.125H59.125V13.4375C59.125 11.2992 58.2756 9.24846 56.7635 7.73645C55.2515 6.22444 53.2008 5.375 51.0625 5.375H34.9375ZM34.9375 10.75H51.0625C51.7753 10.75 52.4588 11.0331 52.9629 11.5372C53.4669 12.0412 53.75 12.7247 53.75 13.4375V16.125H32.25V13.4375C32.25 12.7247 32.5331 12.0412 33.0372 11.5372C33.5412 11.0331 34.2247 10.75 34.9375 10.75V10.75Z"
                    fill="url(#paint0_linear)"
                    fill-opacity="1"
                  />
                  <path
                    d="M0 67.1875C0 69.3258 0.84944 71.3765 2.36145 72.8886C3.87346 74.4006 5.92419 75.25 8.0625 75.25H77.9375C80.0758 75.25 82.1265 74.4006 83.6385 72.8886C85.1506 71.3765 86 69.3258 86 67.1875V36.8188L43.6934 48.0901C43.2391 48.2114 42.7609 48.2114 42.3066 48.0901L0 36.8188V67.1875Z"
                    fill="url(#paint1_linear)"
                    fill-opacity="1"
                  />
                </g>
                <defs>
                  <linearGradient
                    id="paint0_linear"
                    x1="43"
                    y1="5"
                    x2="43"
                    y2="88"
                    gradientUnits="userSpaceOnUse"
                  >
                    <stop stop-color="#FBC8D4" />
                    <stop offset="1" stop-color="#9795F0" />
                  </linearGradient>
                  <linearGradient
                    id="paint1_linear"
                    x1="43"
                    y1="28"
                    x2="43"
                    y2="75.25"
                    gradientUnits="userSpaceOnUse"
                  >
                    <stop stop-color="#FBC8D4" />
                    <stop offset="1" stop-color="#9795F0" />
                  </linearGradient>
                  <clipPath id="clip0">
                    <rect width="86" height="86" fill="white" />
                  </clipPath>
                </defs>
              </svg>
              <div class="tooltip">
                <h5>Productivity</h5>
                <p id="user-productivity"></p>
              </div>
            </div>
            <div class="user-stat">
              <svg
                width="16"
                height="16"
                viewBox="0 0 66 63"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M33 0C14.7767 0 0 13.9371 0 31.125C0 48.3129 14.7767 62.25 33 62.25C36.0433 62.25 38.5 59.9329 38.5 57.0625C38.5 55.7137 37.95 54.5033 37.07 53.5696C36.2267 52.6704 35.6767 51.46 35.6767 50.1458C35.6767 47.2754 38.1333 44.9583 41.1767 44.9583H47.6667C57.7867 44.9583 66 37.2117 66 27.6667C66 12.3808 51.2233 0 33 0ZM12.8333 31.125C9.79 31.125 7.33333 28.8079 7.33333 25.9375C7.33333 23.0671 9.79 20.75 12.8333 20.75C15.8767 20.75 18.3333 23.0671 18.3333 25.9375C18.3333 28.8079 15.8767 31.125 12.8333 31.125ZM23.8333 17.2917C20.79 17.2917 18.3333 14.9746 18.3333 12.1042C18.3333 9.23375 20.79 6.91667 23.8333 6.91667C26.8767 6.91667 29.3333 9.23375 29.3333 12.1042C29.3333 14.9746 26.8767 17.2917 23.8333 17.2917ZM42.1667 17.2917C39.1233 17.2917 36.6667 14.9746 36.6667 12.1042C36.6667 9.23375 39.1233 6.91667 42.1667 6.91667C45.21 6.91667 47.6667 9.23375 47.6667 12.1042C47.6667 14.9746 45.21 17.2917 42.1667 17.2917ZM53.1667 31.125C50.1233 31.125 47.6667 28.8079 47.6667 25.9375C47.6667 23.0671 50.1233 20.75 53.1667 20.75C56.21 20.75 58.6667 23.0671 58.6667 25.9375C58.6667 28.8079 56.21 31.125 53.1667 31.125Z"
                  fill="url(#paint2_linear)"
                  fill-opacity="1"
                />
                <defs>
                  <linearGradient
                    id="paint2_linear"
                    x1="33"
                    y1="0"
                    x2="33"
                    y2="62.25"
                    gradientUnits="userSpaceOnUse"
                  >
                    <stop stop-color="#FDBB2D" />
                    <stop offset="1" stop-color="#92EBEC" />
                  </linearGradient>
                </defs>
              </svg>
              <div class="tooltip">
                <h5>Creativity</h5>
                <p id="user-creativity">44</p>
              </div>
            </div>
            <div class="user-stat">
              <svg
                width="16"
                height="16"
                viewBox="0 0 65 64"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M32.5 64L27.7875 59.3962C11.05 43.1084 0 32.3662 0 19.1826C0 8.44033 7.865 0 17.875 0C23.53 0 28.9575 2.82507 32.5 7.28937C36.0425 2.82507 41.47 0 47.125 0C57.135 0 65 8.44033 65 19.1826C65 32.3662 53.95 43.1085 37.2125 59.4311L32.5 64Z"
                  fill="url(#paint3_linear)"
                  fill-opacity="1"
                />
                <defs>
                  <linearGradient
                    id="paint3_linear"
                    x1="32"
                    y1="-16"
                    x2="32.5"
                    y2="64"
                    gradientUnits="userSpaceOnUse"
                  >
                    <stop stop-color="#C4C4C4" />
                    <stop offset="0.0001" stop-color="#FFC371" />
                    <stop offset="1" stop-color="#FF5F6D" />
                  </linearGradient>
                </defs>
              </svg>
              <div class="tooltip">
                <h5>Health</h5>
                <p id="user-health"></p>
              </div>
            </div>
          </div>
          <div class="user-level">
            <div class="level-meter">
              <hr id="level-gain" />
              <hr id="level-bar" />
            </div>
            <p id="user-currLevel"></p>
          </div>
        </div>
        <div class="profile-div">
          <div class="user-avatar"></div>
          <svg onclick="viewTaskHistory();" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
</svg>
          <p id="user-name"></p>
          <a id="logout" onclick="logout();"> Log out </a>
        </div>
      </div>

      <div class="main-body" id="main-body">
        <div class="container-header">
          <h1 class="headers">Pending Tasks</h1>
          <div class="dropdown">
            <button class="dropbtn">
              Add Task
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="15"
                height="15"
                fill="currentColor"
                class="bi bi-plus-lg"
                viewBox="0 0 16 16"
              >
                <path
                  d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z"
                />
              </svg>
            </button>
            <div class="dropdown-content">
              <a onclick="openCustomTask();">Custom Task</a>
              <a onclick="openBrowseTasks();">Browse</a>
            </div>
          </div>
        </div>
        <div class="task-card-container" id="pending-container"></div>
        <h4 id="viewAllPendingTasks" onclick="load_tasks(true);">View all</h4>
        <h4 id="viewLessPendingTasks" onclick="load_tasks(false);">View less</h4>
        <div id="noPendingTask">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            fill="currentColor"
            class="bi bi-moon-stars-fill"
            viewBox="0 0 16 16"
          >
            <path
              d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"
            />
            <path
              d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"
            />
          </svg>
          <h1>You have no pending tasks</h1>
        </div>

        <div class="container-header">
          <h1 class="headers" id="headerRecommended">Recommended Tasks</h1>
        </div>
        <div class="task-card-container" id="recommended-container"></div>
      </div>
    </div>

    <div class="modal" id="browseTasks">
      <div class="modal-content">
        <div class="modal-header">
          <h1>Browse Tasks</h1>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            fill="currentColor"
            class="bi bi-x-lg"
            id="icon-closeBrowseTasks"
            onclick="closeBrowseTasks();"
            viewBox="0 0 16 16"
            role="button"
          >
            <path
              d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"
            />
          </svg>
        </div>
        <div class="modal-body">
          <input
            type="text"
            id="search_task"
            placeholder="Search"
            onkeyup="search_task();"
          />
          <div class="tags-container">
            <h5>Tags:</h5>
            <button id="tag-creativity" onclick="selectTag('tag-creativity');">
              Creativity •
            </button>
            <button
              id="tag-productivity"
              onclick="selectTag('tag-productivity');"
            >
              Productivity •
            </button>
            <button id="tag-health" onclick="selectTag('tag-health');">
              Health •
            </button>
          </div>
          <div class="container-taskResults" id="container-taskResults"></div>
        </div>
      </div>
    </div>

    <div class="modal" id="customTask">
      <div class="modal-content">
        <div class="modal-header">
          <h1>Create Task</h1>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            fill="currentColor"
            class="bi bi-x-lg"
            id="icon-closeBrowseTasks"
            onclick="closeCustomTask();"
            viewBox="0 0 16 16"
            role="button"
          >
            <path
              d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"
            />
          </svg>
        </div>
        <div class="modal-body">
          <div id="form-createTasks">
            <input
              id="titleCreate"
              type="text"
              placeholder="Tasks Name"
              required
            />
            <div class="bottom-container">
              <div class="dropdown-category-container">
                <h4>Category</h4>
                <select name="Category" id="dropdown-category" required>
                  <option value="health">Health</option>
                  <option value="productivity">Productivity</option>
                  <option value="creativity">Creativity</option>
                </select>
              </div>
              <div class="container-slider">
                <div class="range-value">
                  <h4 id="rangeValue">Value: 1</h4>
                </div>
                <input
                  type="range"
                  min="1"
                  max="5"
                  value="1"
                  class="slider"
                  id="rangeSlider"
                  oninput="sliderDrag(this.value)"
                  required
                />
              </div>
            </div>
        </div>

          <div class="modal-buttons">
            <button class="bg-darkgray" onclick="closeCustomTask();">
              Cancel
            </button>
            <button
              type="button"
              onclick="create_task()"
            >
              Save
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal" id="taskHistory">
      <div class="modal-content">
        <div class="modal-header">
          <h1>Task History</h1>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            fill="currentColor"
            class="bi bi-x-lg"
            id="icon-closeBrowseTasks"
            onclick="viewTaskHistory();"
            viewBox="0 0 16 16"
            role="button"
          >
            <path
              d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"
            />
          </svg>
        </div>
        <div class="modal-body">
          <div class="container-taskHistory" id="container-taskHistory"></div>
        </div>
      </div>
    </div>
  </body>
</html>
