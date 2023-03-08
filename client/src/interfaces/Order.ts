import IProduct from "./Product";

interface IOrder {
  id: number;
  order_code: string;
  shipping_name: string;
  shipping_address: string;
  shipping_country_id: null | number;
  shipping_city_id: number;
  shipping_district_id: number;
  shipping_ward_id: number;
  shipping_phone: string;
  payment_method: string;
  payment_code: null;
  total_price: string;
  total_discount: string;
  total_tax: string;
  total_shipping: string;
  total_payment_fee: string;
  total: string;
  order_status_id: 1;
  order_status_value: string;
  number_order_items: string;
  coupon: null;
  order_items: IOrderItem[];
  created_at: string;
  updated_at: string;
}

export interface IOrderItem {
  color_id: number;
  color_name: string;
  color_value: string;
  coupon_code: null | string;
  created_at: string;
  discount: string;
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
    };
    name: string;
    sku: string;
    slug: string;
    thumbnail_url: string;
    updated_at: string;
    views_count: null | number;
  };
  item_name: string;
  order_code: string;
  order_status_value: string;
  price: number;
  quantity: number;
  size_id: number;
  size_value: string;
  updated_at: string;
  uuid: string;
  variants: {
    color: {
      created_at: string;
      id: number;
      name: string;
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
      views_count: null | null;
    };
    item_id: 1;
    lowest_in_stock_item_stock: {
      id: 1;
      is_sale: null;
      old_price: string;
      price: string;
      price_in: string;
      price_out: string;
      stock_status: number;
    };
    lowest_price: null;
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

export default IOrder;
