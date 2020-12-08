import 'package:cloud_firestore/cloud_firestore.dart';
import 'package:firebase_auth/firebase_auth.dart';

import '../models/chat.dart';
import '../models/conversation.dart';

class ChatRepository {
  final FirebaseAuth _auth = FirebaseAuth.instance;

//  User _userFromFirebaseUser(User user) {
//    return user != null ? User(uid: user.uid) : null;
//  }

  Future signInWithToken(String token) async {
    try {
      UserCredential result = await _auth.signInWithCustomToken(token);
      if (result.user != null) {
        return true;
      } else {
        return null;
      }
    } catch (e) {
      print(e.toString());
      return null;
    }
  }

  Future signUpWithEmailAndPassword(String email, String password) async {
    try {
      UserCredential result = await _auth.createUserWithEmailAndPassword(email: email, password: password);
      if (result.user != null) {
        return true;
      } else {
        return null;
      }
    } catch (e) {
      print(e.toString());
      return null;
    }
  }

  Future signOut() async {
    try {
      return await _auth.signOut();
    } catch (e) {
      print(e.toString());
      return null;
    }
  }

  Future<void> addUserInfo(userData) async {
    FirebaseFirestore.instance.collection("users").add(userData).catchError((e) {
      print(e.toString());
    });
  }

  getUserInfo(String token) async {
    return FirebaseFirestore.instance.collection("users").where("token", isEqualTo: token).get().catchError((e) {
      print(e.toString());
    });
  }

  searchByName(String searchField) {
    return FirebaseFirestore.instance.collection("users").where('userName', isEqualTo: searchField).get();
  }

  // Create Conversation
  Future<void> createConversation(Conversation conversation) {
    return FirebaseFirestore.instance.collection("conversations").doc(conversation.id).set(conversation.toMap()).catchError((e) {
      print(e);
    });
  }

  Future<Stream<QuerySnapshot>> getUserConversations(String userId) async {
    return await FirebaseFirestore.instance
        .collection("conversations")
        .where('visible_to_users', arrayContains: userId)
        //.orderBy('time', descending: true)
        .snapshots();
  }

  Future<Stream<QuerySnapshot>> getChats(Conversation conversation) async {
    return updateConversation(conversation.id, {'read_by_users': conversation.readByUsers}).then((value) async {
      return await FirebaseFirestore.instance
          .collection("conversations")
          .doc(conversation.id)
          .collection("chats")
          .orderBy('time', descending: true)
          .snapshots();
    });
  }

  Future<void> addMessage(Conversation conversation, Chat chat) {
    return FirebaseFirestore.instance.collection("conversations").doc(conversation.id).collection("chats").add(chat.toMap()).whenComplete(() {
      updateConversation(conversation.id, conversation.toUpdatedMap());
    }).catchError((e) {
      print(e.toString());
    });
  }

  Future<void> updateConversation(String conversationId, Map<String, dynamic> conversation) {
    return FirebaseFirestore.instance.collection("conversations").doc(conversationId).update(conversation).catchError((e) {
      print(e.toString());
    });
  }
}
