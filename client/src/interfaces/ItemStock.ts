interface IItemStock {
  box_condition_value: string;
  code: string;
  color_name: string;
  color_value: string;
  condition_value: string | null;
  created_at: string;
  id: number;
  item: {
    brand_id: number;
    created_at: string;
    description: string;
    id: number;
    media: {
      file_name: string;
      full_url: string;
      id: number;
      order_column: number;
      path: string;
      url: string;
    }[];
    name: string;
    sku: string;
    slug: string;
    thumbnail_url: string;
    updated_at: string;
    views_count: null | number;
  };
  price: string;
  price_in: string;
  price_out: string;
  size_value: string;
  sku: string;
  status: number;
  stock_in_date: null | string;
  stock_in_note: null | string;
  stock_in_type: null | string;
  stock_out_date: string;
  stock_out_note: null;
  stock_out_type: number;
  stock_status: number;
  stock_status_id: number;
  variant: {
    color: {
      created_at: string;
      id: number;
      name: number;
      order: number;
      status: number;
      updated_at: string;
      value: string;
    };
    color_id: number;
    id: number;
    item: {
      brand_id: number;
      created_at: string;
      description: string;
      id: number;
      media: {
        file_name: string;
        full_url: string;
        id: number;
        order_column: number;
        path: string;
        url: string;
      }[];
      name: string;
      sku: string;
      slug: string;
      thumbnail_url: string;
      updated_at: string;
      views_count: null | number;
    };
    item_id: number;
    lowest_in_stock_item_stock: {
      box_condition_value: null | string;
      code: string;
      color_name: string;
      color_value: string;
      condition_value: null;
      created_at: string;
      id: number;
      price: string;
      price_in: string;
      price_out: string;
      size_value: string;
      sku: string;
      status: number;
      stock_in_date: null | string;
      stock_in_note: null | string;
      stock_in_type: null | string;
      stock_out_date: string;
      stock_out_note: null | string;
      stock_out_type: number;
      stock_status: number;
      stock_status_id: number;
    };
    lowest_price: string | null;
    size: {
      created_at: string;
      id: number;
      item_category_id: number;
      item_person_type_id: number;
      order: number;
      status: number;
      updated_at: string;
      value: string;
    };
    size_id: number;
    sku: string;
    status: number;
  };
}

export default IItemStock;
