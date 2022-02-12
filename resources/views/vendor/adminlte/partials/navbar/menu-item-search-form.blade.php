
  <form class="form-inline ml-0 ml-md-3 " action="{{ $item['href'] }}" method="{{ $item['method'] }}" >
     {{ csrf_field() }}
    <div class="input-group input-group-lg ">
      
      <div class="input-group-append" >
        <button class="btn btn-navbar " type="submit" style="border-radius: 200px 0px 0px 200px; ">
          <i class="fas fa-search"></i>
        </button>
      </div>
      <input class="form-control form-control-navbar" type="search" placeholder="search option2health" aria-label="Search"  name="{{ $item['input_name'] }}"   placeholder="{{ $item['text'] }}" aria-label="{{ $item['aria-label'] ?? $item['text'] }}"  style="border-radius: 0px 200px 200px 0px; ">
    </div>
  </form>

