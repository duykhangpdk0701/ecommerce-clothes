interface IQuotes {
  id: number;
  quote_code: string;
  user: null;
  email: null;
  shipping_name: string | null;
  shipping_address: string | null;
  shipping_city: string | null;
  shipping_district: string | null;
  shipping_ward: string | null;
  shipping_phone: string | null;
  payment_method: string | null;
  payment_method_data: string | null;
  quote_detail: IQuoteDetail[];
  shipping_fee: string;
  total_price: string;
  total_discount: string;
  total_shipping: string;
  total: string;
  total_tax: null;
}

export interface IQuoteDetail {
  id: number;
  item: {
    id: number;
    slug: string;
    sku: string;
    name: string;
    description: string;
    thumbnail_url: string;
    brand_id: number;
    views_count: null | number;
    media: {
      id: number;
      file_name: string;
      url: string;
      full_url: string;
      path: string;
      order_column: number;
    }[];
    created_at: string;
    updated_at: string;
  };
  size_id: number;
  size_value: string;
  color_id: number;
  color_name: string;
  color_value: string;
  item_price: string;
  total_price: string;
  quantity: number;
  items: string | null;
  thumbnail_url: string | null;
  condition: string;
  created_at: string;
  coupon_code: any;
  discount: any;
}

export default IQuotes;
