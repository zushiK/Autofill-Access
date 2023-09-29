export interface UserType {
  id: number;
  social_id: string;
  provider: string;
  name: string;
  email: string;
  avatar: string;
  avatar_original: string;
  remember_token: string;
  created_at: Date;
  updated_at: Date;
}
